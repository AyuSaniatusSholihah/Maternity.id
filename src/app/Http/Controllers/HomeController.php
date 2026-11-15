<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Event;
use App\Models\Material;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $fallbackImage = config('app.fallback_image_url');

        $eventCategories = Event::query()
            ->whereNotNull('categories')
            ->distinct()
            ->orderBy('categories')
            ->pluck('categories')
            ->map(fn (string $category): array => [
                'slug' => $category,
                'name' => ucfirst($category),
            ])
            ->prepend(['slug' => 'all', 'name' => 'Semua'])
            ->values()
            ->all();

        $ebookCategoryIds = Material::query()
            ->whereNotNull('categories')
            ->distinct()
            ->pluck('categories');
        $ebookCategories = Category::query()
            ->whereIn('id', $ebookCategoryIds)
            ->orderBy('name')
            ->get(['slug', 'name'])
            ->map(fn (Category $category): array => [
                'slug' => $category->slug,
                'name' => $category->name,
            ])
            ->prepend(['slug' => 'all', 'name' => 'Semua'])
            ->values()
            ->all();

        $productCategoryIds = Product::query()
            ->whereNotNull('categories')
            ->distinct()
            ->pluck('categories');
        $productCategories = Category::query()
            ->whereIn('id', $productCategoryIds)
            ->orderBy('name')
            ->get(['slug', 'name'])
            ->map(fn (Category $category): array => [
                'slug' => $category->slug,
                'name' => $category->name,
            ])
            ->prepend(['slug' => 'all', 'name' => 'Semua'])
            ->values()
            ->all();

        $events = Event::query()
            ->latest('event_date')
            ->take(3)
            ->get()
            ->map(function (Event $event) use ($fallbackImage) {
                $isOnline = str_contains(strtolower($event->location), 'online');

                return [
                    'id' => $event->id,
                    'slug' => $event->slug,
                    'title' => $event->title,
                    'description' => $event->description,
                    'date_string' => $event->event_date?->format('d M Y') ?? 'Jadwal Terbuka',
                    'format' => $isOnline ? 'ONLINE' : 'OFFLINE',
                    'format_type' => $isOnline ? 'online' : 'offline',
                    'category' => ucfirst($event->categories),
                    'price' => $event->fee > 0 ? 'Rp ' . number_format($event->fee, 0, ',', '.') : 'Gratis',
                    'thumbnail_image' => $event->image_url ?: $fallbackImage,
                ];
            })
            ->all();

        $ebooks = Material::with('uploader')
            ->latest()
            ->take(4)
            ->get()
            ->map(function (Material $material) {
                return [
                    'id' => $material->id,
                    'title' => $material->title,
                    'book_title' => $material->title,
                    'cover' => $material->image_url,
                    'author' => $material->uploader?->name ?? 'Maternity.id',
                    'price' => 'Gratis',
                    'link_text' => 'Akses online',
                    'btn_text' => 'Baca Sekarang',
                    'url' => route('library'),
                ];
            })
            ->all();

        $articles = Article::with('category')
            ->latest()
            ->take(6)
            ->get()
            ->map(function (Article $article) use ($fallbackImage) {
                return [
                    'category_slug' => $article->category?->slug ?? 'artikel',
                    'category_name' => $article->category?->name ?? 'Artikel',
                    'title' => $article->title,
                    'meta' => $article->created_at?->format('d M Y'),
                    'image' => $article->image_url ?: $fallbackImage,
                    'link' => route('articles.show', $article->slug),
                ];
            })
            ->all();

        $products = Product::with('category')
            ->latest()
            ->take(4)
            ->get()
            ->map(function (Product $product) use ($fallbackImage) {
                return [
                    'id' => $product->id,
                    'title' => $product->name,
                    'tag' => $product->category?->name ?? 'Produk',
                    'image' => $product->thumbnail_img ?: $fallbackImage,
                    'location' => 'Maternity.id',
                    'price' => 'Rp ' . number_format($product->price, 0, ',', '.'),
                    'tiktok_url' => $product->affiliate_url ?: ($product->tiktok_url ?: ($product->whatsapp_url ?: '#')),
                    'affiliate_url' => $product->affiliate_url,
                ];
            })
            ->all();

        return view('landing', compact(
            'events',
            'ebooks',
            'articles',
            'products',
            'eventCategories',
            'ebookCategories',
            'productCategories',
        ));
    }
}
