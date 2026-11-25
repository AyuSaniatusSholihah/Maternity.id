<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminArticleController extends Controller
{
    public function index(): View
    {
        return view('admin.articles.index', [
            'articles' => Article::query()->with('category')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.create', [
            'article' => null,
            'adminCategories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function edit(string $id): View
    {
        return view('admin.articles.create', [
            'article' => Article::query()->findOrFail($id),
            'adminCategories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateArticle($request);

        $user = $request->user();
        \App\Models\Admin::firstOrCreate(
            ['account_id' => $user->id],
            [
                'name' => $user->name ?? 'Administrator',
                'email' => $user->email,
                'phone' => '081234567890',
                'role' => 'active',
            ]
        );

        Article::create([
            ...$validated,
            'slug' => $this->uniqueSlug($validated['title']),
            'image_url' => $this->storeCoverImage($request),
            'author' => $user->id,
        ]);

        return redirect()->route('admin.article')->with('status', 'Artikel berhasil ditambahkan.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $article = Article::query()->findOrFail($id);
        $validated = $this->validateArticle($request);
        $updates = [
            ...$validated,
            'slug' => $this->uniqueSlug($validated['title'], $article->id),
        ];

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($article->image_url);
            $updates['image_url'] = $this->storeCoverImage($request);
        }

        $article->update($updates);

        return redirect()->route('admin.article')->with('status', 'Artikel berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $article = Article::query()->findOrFail($id);
        $this->deleteStoredImage($article->image_url);
        $article->delete();

        return redirect()->route('admin.article')->with('status', 'Artikel berhasil dihapus.');
    }

    private function validateArticle(Request $request): array
    {
        return $request->validate([
            'categories' => ['required', 'uuid', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg', 'max:5120'],
        ]);
    }

    private function storeCoverImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        return Storage::disk('public')->url($request->file('image')->store('article-covers', 'public'));
    }

    private function deleteStoredImage(?string $url): void
    {
        if ($url && str_contains($url, '/storage/')) {
            Storage::disk('public')->delete(Str::after($url, '/storage/'));
        }
    }

    private function uniqueSlug(string $title, ?string $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $suffix = 2;

        while (Article::query()->where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        return $slug;
    }
}
