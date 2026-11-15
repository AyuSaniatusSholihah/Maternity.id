<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function create(): View
    {
        return view('admin.products.create', [
            'adminCategories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::query()->with('category')->latest()->get(),
        ]);
    }

    public function edit(string $id): View
    {
        return view('admin.products.edit', [
            'product' => Product::query()->findOrFail($id),
            'adminCategories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'categories' => ['required', 'uuid', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'affiliate_url' => ['required', 'url', 'max:2048'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        $imagePath = $request->file('image')->store('product-images', 'public');

        Product::create([
            'categories' => $validated['categories'],
            'name' => $validated['name'],
            'slug' => $this->uniqueSlug($validated['name']),
            'description' => $validated['description'] ?? $validated['name'],
            'price' => $validated['price'],
            'thumbnail_img' => Storage::disk('public')->url($imagePath),
            'affiliate_url' => $validated['affiliate_url'],
            'created_by' => $request->user()->id,
        ]);

        return redirect()
            ->route('admin.product')
            ->with('status', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $product = Product::query()->findOrFail($id);

        $validated = $request->validate([
            'categories' => ['required', 'uuid', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'affiliate_url' => ['required', 'url', 'max:2048'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        $updates = [
            'categories' => $validated['categories'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? $validated['name'],
            'price' => $validated['price'],
            'affiliate_url' => $validated['affiliate_url'],
        ];

        if ($product->name !== $validated['name']) {
            $updates['slug'] = $this->uniqueSlug($validated['name'], $product->id);
        }

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($product->thumbnail_img);
            $imagePath = $request->file('image')->store('product-images', 'public');
            $updates['thumbnail_img'] = Storage::disk('public')->url($imagePath);
        }

        $product->update($updates);

        return redirect()
            ->route('admin.product')
            ->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $product = Product::query()->findOrFail($id);
        $this->deleteStoredImage($product->thumbnail_img);
        $product->delete();

        return redirect()
            ->route('admin.product')
            ->with('status', 'Produk berhasil dihapus.');
    }

    private function uniqueSlug(string $name, ?string $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $suffix = 2;

        while (Product::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        return $slug;
    }

    private function deleteStoredImage(?string $imageUrl): void
    {
        if (! $imageUrl) {
            return;
        }

        $path = parse_url($imageUrl, PHP_URL_PATH);
        $storagePrefix = '/storage/';

        if (is_string($path) && str_starts_with($path, $storagePrefix)) {
            Storage::disk('public')->delete(substr($path, strlen($storagePrefix)));
        }
    }
}
