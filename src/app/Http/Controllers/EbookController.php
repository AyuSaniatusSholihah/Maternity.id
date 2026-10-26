<?php

namespace App\Http\Controllers;

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

        // Query materials dengan eager loading uploader relation
        $query = Material::with('uploader.account');

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

        $allMaterials = $query->get();

        // Transform Material model ke format yang dipakai view
        $ebooks = $allMaterials->map(function ($material) {
            return [
                'id' => $material->id,
                'title' => $material->title,
                'book_title' => $material->title,
                'description' => $material->description,
                'cover' => $material->image_url ?? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80',
                'author' => $material->uploader?->name ?? 'Tim Medis Maternity.id',
                'price' => 'Gratis',
                'link_text' => 'akses online',
                'handle' => '@maternity.id',
                'btn_text' => 'Baca Sekarang',
                'url' => $material->content_link,
            ];
        })->values()->toArray();

        return view('library.index', [
            'ebooks' => $ebooks,
            'currentSort' => $sort,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
        ]);
    }
}
