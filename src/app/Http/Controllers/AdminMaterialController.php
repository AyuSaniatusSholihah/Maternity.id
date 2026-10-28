<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminMaterialController extends Controller
{
    public function create(): View
    {
        return view('admin.materials.create', [
            'adminCategories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function index(): View
    {
        $materials = Material::query()
            ->with(['category', 'uploader.account', 'events'])
            ->latest()
            ->get()
            ->map(fn (Material $material): array => [
                'id' => $material->id,
                'title' => $material->title,
                'slug' => $material->slug,
                'description' => $material->description,
                'fileName' => $material->content && Storage::disk('public')->exists($material->content)
                    ? basename($material->content)
                    : null,
                'downloadUrl' => $material->content && Storage::disk('public')->exists($material->content)
                    ? route('admin.ebook.download', $material->slug)
                    : null,
                'uploadedBy' => $material->uploaded_by,
                'imageUrl' => $material->image_url ?: asset('images/placeholder.jpg'),
                'category' => $material->category?->name ?? 'Tanpa kategori',
                'uploader' => $material->uploader?->account?->name ?? 'Tidak diketahui',
                'uploaderEmail' => $material->uploader?->account?->email ?? '-',
                'events' => $material->events->pluck('title')->values()->all(),
                'createdAt' => $material->created_at?->format('d M Y H:i') ?? '-',
                'updatedAt' => $material->updated_at?->format('d M Y H:i') ?? '-',
            ])
            ->values();

        return view('admin.dashboard', [
            'adminMaterials' => $materials,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'categories' => ['required', 'uuid', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'pdf_file' => ['required', 'file', 'mimes:pdf', 'max:51200'],
            'image_url' => ['nullable', 'url', 'max:255'],
        ]);

        $slug = $this->uniqueSlug($validated['title']);
        $filePath = $request->file('pdf_file')->store('ebooks', 'public');

        Material::create([
            'categories' => $validated['categories'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $filePath,
            'image_url' => $validated['image_url'] ?? null,
            'slug' => $slug,
            'uploaded_by' => $request->user()->id,
        ]);

        return redirect()
            ->route('admin.ebook')
            ->with('status', 'E-book berhasil ditambahkan.');
    }

    public function download(string $slug): BinaryFileResponse
    {
        $material = Material::query()->where('slug', $slug)->firstOrFail();

        abort_unless(Storage::disk('public')->exists($material->content), 404);

        return response()->download(
            Storage::disk('public')->path($material->content),
            basename($material->content),
            ['Content-Type' => 'application/pdf'],
        );
    }

    private function uniqueSlug(string $title): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $suffix = 2;

        while (Material::query()->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $suffix++;
        }

        return $slug;
    }
}