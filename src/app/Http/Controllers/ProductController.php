<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Data Produk Fisik & Merchandise Maternity.id
     */
    private function getCuratedProducts()
    {
        return [
            [
                'id' => 1,
                'title' => 'Set Baju Perawat Premium',
                'tag' => 'Perlengkapan Nakes',
                'tag_slug' => 'perlengkapan-nakes',
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop&q=80',
                'location' => 'Surakarta',
                'price' => 'Rp 145.000',
                'tiktok_url' => '#',
                'rating' => 4.9,
                'sold' => '250+'
            ],
            [
                'id' => 2,
                'title' => 'Bantal Hamil Ergonomis U-Shape',
                'tag' => 'Kebutuhan Wanita',
                'tag_slug' => 'kebutuhan-wanita',
                'image' => 'https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=600&auto=format&fit=crop&q=80',
                'location' => 'Yogyakarta',
                'price' => 'Rp 185.000',
                'tiktok_url' => '#',
                'rating' => 5.0,
                'sold' => '420+'
            ],
            [
                'id' => 3,
                'title' => 'Tas Perlengkapan Bayi Waterproof',
                'tag' => 'Perawatan Ibu & Bayi',
                'tag_slug' => 'perawatan-ibu-bayi',
                'image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=600&auto=format&fit=crop&q=80',
                'location' => 'Jakarta Selatan',
                'price' => 'Rp 210.000',
                'tiktok_url' => '#',
                'rating' => 4.8,
                'sold' => '180+'
            ],
            [
                'id' => 4,
                'title' => 'Korset Nifas Medis Pasca Melahirkan',
                'tag' => 'Kebutuhan Wanita',
                'tag_slug' => 'kebutuhan-wanita',
                'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=600&auto=format&fit=crop&q=80',
                'location' => 'Surakarta',
                'price' => 'Rp 125.000',
                'tiktok_url' => '#',
                'rating' => 4.9,
                'sold' => '310+'
            ],
            [
                'id' => 5,
                'title' => 'Stetoskop Medis Rose Gold Edition',
                'tag' => 'Perlengkapan Nakes',
                'tag_slug' => 'perlengkapan-nakes',
                'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=600&auto=format&fit=crop&q=80',
                'location' => 'Surabaya',
                'price' => 'Rp 275.000',
                'tiktok_url' => '#',
                'rating' => 5.0,
                'sold' => '95+'
            ],
            [
                'id' => 6,
                'title' => 'Nursing Apron / Penutup Menyusui',
                'tag' => 'Kebutuhan Wanita',
                'tag_slug' => 'kebutuhan-wanita',
                'image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?w=600&auto=format&fit=crop&q=80',
                'location' => 'Bandung',
                'price' => 'Rp 65.000',
                'tiktok_url' => '#',
                'rating' => 4.9,
                'sold' => '540+'
            ],
            [
                'id' => 7,
                'title' => 'Minyak Pijat Bayi Alami Chamomile',
                'tag' => 'Perawatan Ibu & Bayi',
                'tag_slug' => 'perawatan-ibu-bayi',
                'image' => 'https://images.unsplash.com/photo-1608248597359-2c70f074d284?w=600&auto=format&fit=crop&q=80',
                'location' => 'Surakarta',
                'price' => 'Rp 45.000',
                'tiktok_url' => '#',
                'rating' => 4.8,
                'sold' => '620+'
            ],
            [
                'id' => 8,
                'title' => 'Teh Herbal Pelancar ASI Organik',
                'tag' => 'Nutrisi & Suplemen',
                'tag_slug' => 'nutrisi-suplemen',
                'image' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?w=600&auto=format&fit=crop&q=80',
                'location' => 'Yogyakarta',
                'price' => 'Rp 55.000',
                'tiktok_url' => '#',
                'rating' => 4.9,
                'sold' => '390+'
            ],
            [
                'id' => 9,
                'title' => 'Gym Ball Senam Hamil Anti-Burst',
                'tag' => 'Kebutuhan Wanita',
                'tag_slug' => 'kebutuhan-wanita',
                'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=600&auto=format&fit=crop&q=80',
                'location' => 'Semarang',
                'price' => 'Rp 110.000',
                'tiktok_url' => '#',
                'rating' => 4.9,
                'sold' => '215+'
            ],
            [
                'id' => 10,
                'title' => 'Pin & Lanyard Bidan Kebidanan',
                'tag' => 'Perlengkapan Nakes',
                'tag_slug' => 'perlengkapan-nakes',
                'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop&q=80',
                'location' => 'Surakarta',
                'price' => 'Rp 30.000',
                'tiktok_url' => '#',
                'rating' => 4.7,
                'sold' => '800+'
            ],
        ];
    }

    /**
     * Tampilkan Halaman Katalog Produk
     */
    public function index(Request $request)
    {
        $allProducts = $this->getCuratedProducts();
        $category = $request->input('category', 'all');
        $query = $request->input('q');

        $products = $allProducts;

        if ($category && $category !== 'all') {
            $products = array_filter($products, function ($p) use ($category) {
                return $p['tag_slug'] === $category;
            });
        }

        if ($query) {
            $products = array_filter($products, function ($p) use ($query) {
                return stripos($p['title'], $query) !== false ||
                       stripos($p['tag'], $query) !== false ||
                       stripos($p['location'], $query) !== false;
            });
        }

        $categories = [
            ['slug' => 'all', 'name' => 'Semua', 'icon' => 'fa-solid fa-shapes'],
            ['slug' => 'perlengkapan-nakes', 'name' => 'Perlengkapan Nakes', 'icon' => 'fa-solid fa-user-nurse'],
            ['slug' => 'kebutuhan-wanita', 'name' => 'Kebutuhan Wanita', 'icon' => 'fa-solid fa-person-dress'],
            ['slug' => 'perawatan-ibu-bayi', 'name' => 'Perawatan Ibu & Bayi', 'icon' => 'fa-solid fa-baby'],
            ['slug' => 'nutrisi-suplemen', 'name' => 'Nutrisi & Suplemen', 'icon' => 'fa-solid fa-apple-whole'],
        ];

        return view('product.index', [
            'products' => array_values($products),
            'categories' => $categories,
            'currentCategory' => $category,
            'searchQuery' => $query ?? '',
        ]);
    }
}
