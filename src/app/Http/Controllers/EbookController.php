<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    /**
     * Tampilkan Halaman Katalog E-book (Library)
     * Menggunakan data dari model Material
     */
    public function index(Request $request)
    {
        // Ambil semua materials dari database
        $allMaterials = Material::all();

        // Transform Material model ke format yang dipakai view
        $ebooks = $allMaterials->map(function ($material) {
            return [
                'id' => $material->id,
                'title' => $material->title,
                'book_title' => $material->title,
                'description' => $material->description,
                'cover' => $material->thumbnail_image ?? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80',
                'author' => 'Tim Medis Maternity.id',
                'price' => 'Gratis',
                'link_text' => 'akses online',
                'handle' => '@maternity.id',
                'btn_text' => 'Baca Sekarang',
                'url' => $material->content_link,
            ];
        })->values()->toArray();

        return view('library.index', [
            'ebooks' => $ebooks,
            'currentSort' => $request->input('sort', 'latest'),
        ]);
    }
}
