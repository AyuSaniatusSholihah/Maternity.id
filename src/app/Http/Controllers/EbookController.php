<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    /**
     * Tampilkan Halaman Katalog E-book (Library)
     * Menggunakan data dari model Material dengan author dari uploaded_by relation
     */
    public function index(Request $request)
    {
        // Ambil sort parameter, default ke 'latest'
        $sort = $request->input('sort', 'latest');
        $dateStart = $request->input('dateStart');
        $dateEnd = $request->input('dateEnd');
        $category = $request->input('category', 'all');

        // Query materials untuk katalog e-book
        $query = Material::query();

        if ($category && $category !== 'all') {
            $query->whereHas('category', function ($categoryQuery) use ($category) {
                $categoryQuery->where('slug', $category);
            });
        }

        // Apply date filtering jika ada
        if ($dateStart && $dateEnd) {
            $query->whereBetween('created_at', [$dateStart . ' 00:00:00', $dateEnd . ' 23:59:59']);
        }

        // Apply sorting
        if ($sort === 'popular') {
            // Sort by viewer_count descending (most popular first)
            $query->orderBy('viewer_count', 'desc');
        } else {
            // Default: sort by created_at descending (most recent first)
            $query->orderBy('created_at', 'desc');
        }

        $ebooks = $query->paginate(12)->withQueryString();

        // Transform Material model ke format yang dipakai view
        $ebooks->getCollection()->transform(function ($material) {
            return [
                'id' => $material->id,
                'title' => $material->title,
                'book_title' => $material->title,
                'description' => $material->description,
                'cover' => $material->image_url ?? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80',
                'author' => '',
                'price' => 'Gratis',
                'link_text' => 'Akses online',
                'handle' => '@maternity.id',
                'btn_text' => 'Baca Sekarang',
                'url' => $material->content,
            ];
        });

        $categories = Category::query()
            ->whereIn('slug', Category::MODULE_SLUGS)
            ->orderBy('name')
            ->get(['slug', 'name'])
            ->map(fn (Category $item): array => [
                'slug' => $item->slug,
                'name' => $item->name,
                'icon' => 'fa-solid fa-book-open',
            ])
            ->prepend([
                'slug' => 'all',
                'name' => 'Semua',
                'icon' => 'fa-solid fa-shapes',
            ])
            ->values()
            ->all();

        return view('library.index', [
            'ebooks' => $ebooks,
            'categories' => $categories,
            'currentCategory' => $category,
            'currentSort' => $sort,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
        ]);
    }
}
