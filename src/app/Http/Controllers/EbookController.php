<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EbookController extends Controller
{
    /**
     * Data E-book & Panduan Digital Maternity.id
     */
    private function getCuratedEbooks()
    {
        return [
            [
                'id' => 1,
                'title' => "Download My New\nebook",
                'cover' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=400&auto=format&fit=crop&q=80',
                'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                'author' => 'Pretty Girls Aesthetics',
                'category' => 'Kehamilan',
                'category_slug' => 'kehamilan',
                'price' => '$25',
                'link_text' => 'link in bio',
                'handle' => '@cute_prettygirlsaesthetics',
                'btn_text' => 'Baca Sekarang',
                'url' => '#',
            ],
            [
                'id' => 2,
                'title' => "Download My New\nebook",
                'cover' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&auto=format&fit=crop&q=80',
                'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                'author' => 'Pretty Girls Aesthetics',
                'category' => 'Parenting',
                'category_slug' => 'parenting',
                'price' => '$25',
                'link_text' => 'link in bio',
                'handle' => '@cute_prettygirlsaesthetics',
                'btn_text' => 'Baca Sekarang',
                'url' => '#',
            ],
            [
                'id' => 3,
                'title' => "Download My New\nebook",
                'cover' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&auto=format&fit=crop&q=80',
                'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                'author' => 'Pretty Girls Aesthetics',
                'category' => 'Nutrisi',
                'category_slug' => 'nutrisi',
                'price' => '$25',
                'link_text' => 'link in bio',
                'handle' => '@cute_prettygirlsaesthetics',
                'btn_text' => 'Baca Sekarang',
                'url' => '#',
            ],
            [
                'id' => 4,
                'title' => "Download My New\nebook",
                'cover' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&auto=format&fit=crop&q=80',
                'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                'author' => 'Pretty Girls Aesthetics',
                'category' => 'Perawatan Bayi',
                'category_slug' => 'perawatan-bayi',
                'price' => '$25',
                'link_text' => 'link in bio',
                'handle' => '@cute_prettygirlsaesthetics',
                'btn_text' => 'Baca Sekarang',
                'url' => '#',
            ],
            [
                'id' => 5,
                'title' => "Download My New\nebook",
                'cover' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=400&auto=format&fit=crop&q=80',
                'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                'author' => 'Pretty Girls Aesthetics',
                'category' => 'Mindfulness',
                'category_slug' => 'mindfulness',
                'price' => '$25',
                'link_text' => 'link in bio',
                'handle' => '@cute_prettygirlsaesthetics',
                'btn_text' => 'Baca Sekarang',
                'url' => '#',
            ],
            [
                'id' => 6,
                'title' => "Download My New\nebook",
                'cover' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&auto=format&fit=crop&q=80',
                'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                'author' => 'Pretty Girls Aesthetics',
                'category' => 'Kesehatan',
                'category_slug' => 'kesehatan',
                'price' => '$25',
                'link_text' => 'link in bio',
                'handle' => '@cute_prettygirlsaesthetics',
                'btn_text' => 'Baca Sekarang',
                'url' => '#',
            ],
            [
                'id' => 7,
                'title' => "Download My New\nebook",
                'cover' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=400&auto=format&fit=crop&q=80',
                'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                'author' => 'Pretty Girls Aesthetics',
                'category' => 'Kesehatan',
                'category_slug' => 'kesehatan',
                'price' => '$25',
                'link_text' => 'link in bio',
                'handle' => '@cute_prettygirlsaesthetics',
                'btn_text' => 'Baca Sekarang',
                'url' => '#',
            ],
            [
                'id' => 8,
                'title' => "Download My New\nebook",
                'cover' => 'https://images.unsplash.com/photo-1519689680058-324335c77eba?w=400&auto=format&fit=crop&q=80',
                'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                'author' => 'Pretty Girls Aesthetics',
                'category' => 'Nutrisi',
                'category_slug' => 'nutrisi',
                'price' => '$25',
                'link_text' => 'link in bio',
                'handle' => '@cute_prettygirlsaesthetics',
                'btn_text' => 'Baca Sekarang',
                'url' => '#',
            ]
        ];
    }

    /**
     * Tampilkan Halaman Katalog E-book (Library)
     */
    public function index(Request $request)
    {
        $allEbooks = $this->getCuratedEbooks();
        $category = $request->input('category', 'all');
        $sort = $request->input('sort', 'latest');

        $ebooks = $allEbooks;

        if ($category && $category !== 'all') {
            $ebooks = array_filter($ebooks, function ($e) use ($category) {
                return $e['category_slug'] === $category;
            });
        }

        $categories = [
            ['slug' => 'all', 'name' => 'Semua Kategori', 'icon' => 'fa-solid fa-shapes'],
            ['slug' => 'parenting', 'name' => 'Parenting', 'icon' => 'fa-solid fa-people-roof'],
            ['slug' => 'kehamilan', 'name' => 'Kehamilan', 'icon' => 'fa-solid fa-person-pregnant'],
            ['slug' => 'nutrisi', 'name' => 'Nutrisi', 'icon' => 'fa-solid fa-apple-whole'],
            ['slug' => 'kesehatan', 'name' => 'Kesehatan', 'icon' => 'fa-solid fa-heart-pulse'],
            ['slug' => 'perawatan-bayi', 'name' => 'Perawatan Bayi', 'icon' => 'fa-solid fa-baby'],
            ['slug' => 'mindfulness', 'name' => 'Mindfulness', 'icon' => 'fa-solid fa-leaf'],
        ];

        return view('library.index', [
            'ebooks' => array_values($ebooks),
            'categories' => $categories,
            'currentCategory' => $category,
            'currentSort' => $sort,
        ]);
    }
}
