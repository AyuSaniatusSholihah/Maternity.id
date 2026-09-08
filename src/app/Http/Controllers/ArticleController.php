<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Data artikel kurasi lengkap sesuai desain Maternity.id
     */
    private function getCuratedArticles()
    {
        return [
            [
                'id' => '1',
                'slug' => 'nutrisi-seimbang-untuk-ibu-hamil',
                'title' => 'Nutrisi Seimbang untuk Ibu Hamil',
                'category' => 'Nutrisi Ibu',
                'category_slug' => 'nutrisi-ibu',
                'excerpt' => 'Panduan makanan sehat yang mendukung tumbuh kembang janin dan menjaga kesehatan ibu.',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Memenuhi kebutuhan nutrisi seimbang selama kehamilan sangat penting untuk memastikan pertumbuhan organ janin berlangsung optimal sekaligus menjaga daya tahan tubuh ibu tetap prima.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">1. Komposisi Piring Nutrisi Ibu Hamil</h3>
                    <p class="text-neutral-700 leading-relaxed mb-4">Pastikan setiap kali makan terdiri dari karbohidrat kompleks (nasi merah, ubi, oatmeal), protein hewani & nabati bermutu tinggi (ikan salmon, telur, tahu, tempe), sayuran hijau kaya asam folat, serta buah-buahan segar bervitamin C.</p>

                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">2. Suplementasi Mikro yang Dianjurkan</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li><strong>Asam Folat:</strong> 400 - 800 mcg setiap hari untuk mencegah cacat tabung saraf janin.</li>
                        <li><strong>Zat Besi:</strong> Mencegah anemia dan pendarahan saat persalinan.</li>
                        <li><strong>Kalsium & Vitamin D:</strong> Menjaga kepadatan tulang ibu dan membangun rangka janin.</li>
                    </ul>
                ',
                'author' => 'dr. Annisa Pratama, Sp.OG',
                'author_role' => 'Dokter Spesialis Obstetri & Ginekologi',
                'author_avatar' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=200',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=800',
                'read_time' => '5 menit membaca',
                'published_at' => '15 Agustus 2026',
                'views' => '3.8k',
                'is_featured' => true,
                'tags' => ['Nutrisi Ibu', 'Kehamilan Sehat', 'Asam Folat', 'Makanan Sehat']
            ],
            [
                'id' => '2',
                'slug' => 'cara-mengelola-stres-pada-ibu-hamil',
                'title' => 'Cara Mengelola Stres pada Ibu Hamil',
                'category' => 'Kesehatan Wanita',
                'category_slug' => 'kesehatan-wanita',
                'excerpt' => 'Tips sederhana untuk menjaga kesehatan mental selama kehamilan.',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Fluktuasi hormon kehamilan sering memicu perubahan suasana hati dan kecemasan. Relaksasi pikiran dan latihan pernapasan teratur sangat membantu menenangkan sistem saraf.</p>
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Latihan Meditasi & Relaksasi Sederhana</h3>
                    <p class="text-neutral-700 leading-relaxed mb-4">Luangkan waktu 10-15 menit di pagi hari untuk duduk tenang, mendengarkan afirmasi positif kehamilan, dan melakukan pernapasan diafragma yang dalam dan lembut.</p>
                ',
                'author' => 'Rina Sasmita, M.Psi., Psikolog',
                'author_role' => 'Psikolog Klinis Ibu & Anak',
                'author_avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=200',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&q=80&w=800',
                'read_time' => '4 menit membaca',
                'published_at' => '14 Agustus 2026',
                'views' => '2.1k',
                'is_featured' => false,
                'tags' => ['Kesehatan Mental', 'Meditasi', 'Relaksasi Ibu']
            ],
            [
                'id' => '3',
                'slug' => 'pola-tidur-bayi-baru-lahir',
                'title' => 'Pola Tidur Bayi Baru Lahir',
                'category' => 'Perawatan Bayi',
                'category_slug' => 'perawatan-bayi',
                'excerpt' => 'Kenali kebutuhan tidur bayi dan cara membangun rutinitas tidur yang sehat.',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Bayi baru lahir (newborn) rata-rata tidur 14-17 jam sehari dengan siklus 2-4 jam sekali bangun untuk menyusu. Kenali tanda-tanda bayi mengantuk sebelum ia over-tired.</p>
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Tanda Bayi Mengantuk</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Menggosok-gosok mata atau menarik telinga.</li>
                        <li>Menguap dan tatapan mata mulai sayu.</li>
                        <li>Gerakan tangan dan kaki mulai melambat.</li>
                    </ul>
                ',
                'author' => 'Bidan Kartika Sari, S.Tr.Keb',
                'author_role' => 'Praktisi Gentle Birth & Newborn Care',
                'author_avatar' => 'https://images.unsplash.com/photo-1594824813533-9799276d4990?auto=format&fit=crop&q=80&w=200',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=800',
                'read_time' => '5 menit membaca',
                'published_at' => '12 Agustus 2026',
                'views' => '4.2k',
                'is_featured' => false,
                'tags' => ['Perawatan Bayi', 'Tidur Bayi', 'Newborn']
            ],
            [
                'id' => '4',
                'slug' => 'minum-air-putih-yang-cukup',
                'title' => 'Minum Air Putih yang Cukup',
                'category' => 'Nutrisi Ibu',
                'category_slug' => 'nutrisi-ibu',
                'excerpt' => 'Manfaat dan tips memenuhi kebutuhan cairan selama kehamilan.',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Kebutuhan cairan ibu hamil meningkat untuk mendukung pembentukan air ketuban, sirkulasi darah ekstra bagi janin, serta mencegah infeksi saluran kemih dan sembelit.</p>
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Tips Hidrasi Harian</h3>
                    <p class="text-neutral-700 leading-relaxed mb-4">Targetkan minimal 8-10 gelas (2,5 liter) air putih setiap hari. Selalu bawa botol minum portabel saat beraktivitas di luar rumah.</p>
                ',
                'author' => 'dr. Annisa Pratama, Sp.OG',
                'author_role' => 'Dokter Spesialis Obstetri & Ginekologi',
                'author_avatar' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=200',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1548839140-29a749e1bc4e?auto=format&fit=crop&q=80&w=800',
                'read_time' => '4 menit membaca',
                'published_at' => '10 Agustus 2026',
                'views' => '1.9k',
                'is_featured' => false,
                'tags' => ['Hidrasi', 'Air Putih', 'Nutrisi Ibu']
            ],
            [
                'id' => '5',
                'slug' => 'peran-suami-mendampingi-kehamilan',
                'title' => 'Peran Suami Mendampingi Kehamilan',
                'category' => 'Keluarga',
                'category_slug' => 'keluarga',
                'excerpt' => 'Dukungan emosional dan fisik dari pasangan kunci sukses kehamilan bahagia.',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Kehamilan adalah perjalanan bersama. Kehadiran aktif suami saat kontrol kandungan, membantu pekerjaan rumah, dan memberikan pijatan lembut sangat mengurangi beban ibu.</p>
                ',
                'author' => 'Rina Sasmita, M.Psi., Psikolog',
                'author_role' => 'Psikolog Klinis Ibu & Anak',
                'author_avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=200',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?auto=format&fit=crop&q=80&w=800',
                'read_time' => '5 menit membaca',
                'published_at' => '08 Agustus 2026',
                'views' => '2.7k',
                'is_featured' => false,
                'tags' => ['Keluarga', 'Ayah Siaga', 'Dukungan Suami']
            ],
            [
                'id' => '6',
                'slug' => 'teknik-memandikan-bayi-baru-lahir',
                'title' => 'Teknik Memandikan Bayi Baru Lahir',
                'category' => 'Perawatan Bayi',
                'category_slug' => 'perawatan-bayi',
                'excerpt' => 'Langkah aman memandikan bayi dengan air hangat dan perawatan tali pusat.',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Memandikan bayi baru lahir tidak perlu lama-lama (cukup 5-10 menit). Pastikan suhu air suam-suam kuku sekitar 37°C dan keringkan tali pusat dengan kasa bersih setelah mandi.</p>
                ',
                'author' => 'Bidan Kartika Sari, S.Tr.Keb',
                'author_role' => 'Praktisi Gentle Birth & Newborn Care',
                'author_avatar' => 'https://images.unsplash.com/photo-1594824813533-9799276d4990?auto=format&fit=crop&q=80&w=200',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1519689680058-324335c77eba?auto=format&fit=crop&q=80&w=800',
                'read_time' => '6 menit membaca',
                'published_at' => '05 Agustus 2026',
                'views' => '3.5k',
                'is_featured' => false,
                'tags' => ['Perawatan Bayi', 'Mandi Bayi', 'Tali Pusat']
            ],
            [
                'id' => '7',
                'slug' => 'variasi-buah-dan-sayur-kaya-antioksidan',
                'title' => 'Variasi Buah & Sayur Kaya Antioksidan',
                'category' => 'Nutrisi Ibu',
                'category_slug' => 'nutrisi-ibu',
                'excerpt' => 'Pilihan buah segar kaya vitamin untuk menjaga imunitas ibu dan perkembangan plasenta.',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Konsumsi aneka warna buah seperti alpukat, pisang, stroberi, dan pepaya menyediakan antioksidan kuat untuk menangkal radikal bebas dan memperlancar pencernaan.</p>
                ',
                'author' => 'dr. Annisa Pratama, Sp.OG',
                'author_role' => 'Dokter Spesialis Obstetri & Ginekologi',
                'author_avatar' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=200',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1490818387583-1baba5e638af?auto=format&fit=crop&q=80&w=800',
                'read_time' => '4 menit membaca',
                'published_at' => '03 Agustus 2026',
                'views' => '2.9k',
                'is_featured' => false,
                'tags' => ['Buah Sehat', 'Nutrisi Ibu', 'Antioksidan']
            ],
        ];
    }

    /**
     * Data Artikel Populer untuk Sidebar
     */
    private function getPopularArticles()
    {
        return [
            [
                'slug' => 'persiapan-menjelang-persalinan',
                'title' => 'Persiapan Menjelang Persalinan',
                'read_time' => '6 menit membaca',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'slug' => 'perawatan-bayi-baru-lahir',
                'title' => 'Perawatan Bayi Baru Lahir',
                'read_time' => '5 menit membaca',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=400',
            ],
            [
                'slug' => 'tips-menjaga-kesehatan-ibu',
                'title' => 'Tips Menjaga Kesehatan Ibu',
                'read_time' => '4 menit membaca',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=400',
            ],
        ];
    }

    /**
     * Tampilkan Halaman Katalog Artikel
     */
    public function index(Request $request)
    {
        $allArticles = $this->getCuratedArticles();
        $query = $request->input('q');
        $categoryFilter = $request->input('category');

        $articles = $allArticles;

        if ($query) {
            $articles = array_filter($articles, function ($item) use ($query) {
                return stripos($item['title'], $query) !== false ||
                       stripos($item['excerpt'], $query) !== false ||
                       in_array(strtolower($query), array_map('strtolower', $item['tags'] ?? []));
            });
        }

        if ($categoryFilter && $categoryFilter !== 'all') {
            $articles = array_filter($articles, function ($item) use ($categoryFilter) {
                return $item['category_slug'] === $categoryFilter;
            });
        }

        // Featured Spotlight Article
        $featuredArticle = null;
        if (empty($query) && (empty($categoryFilter) || $categoryFilter === 'all')) {
            $featuredArticle = $allArticles[0]; // Nutrisi Seimbang untuk Ibu Hamil
            $latestArticles = array_slice($allArticles, 1);
        } else {
            $latestArticles = $articles;
        }

        $categories = [
            ['slug' => 'all', 'name' => 'Semua', 'count' => 57, 'icon' => 'fa-solid fa-shapes'],
            ['slug' => 'nutrisi-ibu', 'name' => 'Nutrisi Ibu', 'count' => 12, 'icon' => 'fa-solid fa-seedling'],
            ['slug' => 'persalinan', 'name' => 'Persalinan', 'count' => 8, 'icon' => 'fa-solid fa-person-pregnant'],
            ['slug' => 'perawatan-bayi', 'name' => 'Perawatan Bayi', 'count' => 14, 'icon' => 'fa-solid fa-baby'],
            ['slug' => 'kesehatan-wanita', 'name' => 'Kesehatan Wanita', 'count' => 10, 'icon' => 'fa-solid fa-heart-pulse'],
            ['slug' => 'keluarga', 'name' => 'Keluarga', 'count' => 7, 'icon' => 'fa-solid fa-house-chimney-user'],
        ];

        return view('articles.index', [
            'articles' => array_values($latestArticles),
            'featuredArticle' => $featuredArticle,
            'popularArticles' => $this->getPopularArticles(),
            'categories' => $categories,
            'currentCategory' => $categoryFilter ?? 'all',
            'searchQuery' => $query ?? '',
        ]);
    }

    /**
     * Tampilkan Detail Artikel
     */
    public function show($slug)
    {
        $allArticles = $this->getCuratedArticles();
        $article = null;

        foreach ($allArticles as $item) {
            if ($item['slug'] === $slug) {
                $article = $item;
                break;
            }
        }

        if (!$article) {
            foreach ($this->getPopularArticles() as $pop) {
                if ($pop['slug'] === $slug) {
                    $article = [
                        'id' => 'pop',
                        'slug' => $pop['slug'],
                        'title' => $pop['title'],
                        'category' => 'Kesehatan Ibu',
                        'category_slug' => 'kesehatan-wanita',
                        'excerpt' => 'Panduan praktis dan tips menjaga kesehatan ibu dan calon buah hati.',
                        'content' => '<p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Persiapan yang matang dan pemahaman yang tepat akan membantu ibu menjalani masa kehamilan dan persalinan dengan tenang, percaya diri, dan nyaman.</p>',
                        'author' => 'dr. Annisa Pratama, Sp.OG',
                        'author_role' => 'Dokter Spesialis Obstetri & Ginekologi',
                        'author_avatar' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&q=80&w=200',
                        'thumbnail_image' => $pop['thumbnail_image'],
                        'read_time' => $pop['read_time'],
                        'published_at' => '15 Agustus 2026',
                        'views' => '2.5k',
                        'tags' => ['Kesehatan', 'Maternitas', 'Tips Ibu']
                    ];
                    break;
                }
            }
        }

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan.');
        }

        $formattedArticle = (object) $article;
        $formattedArticle->category = (object) [
            'name' => $article['category'],
            'slug' => $article['category_slug'] ?? 'all'
        ];
        $formattedArticle->author = (object) [
            'name' => $article['author'],
            'role' => $article['author_role'] ?? 'Verifikator Medis',
            'avatar' => $article['author_avatar'] ?? null,
        ];
        $formattedArticle->image_url = $article['thumbnail_image'];
        $formattedArticle->published_at = \Carbon\Carbon::now()->subDays(4);

        $relatedArticles = array_filter($allArticles, function ($item) use ($article) {
            return $item['slug'] !== $article['slug'];
        });
        
        $formattedRelated = array_map(function ($item) {
            $obj = (object) $item;
            $obj->category = (object) [
                'name' => $item['category'],
                'slug' => $item['category_slug'] ?? 'all'
            ];
            $obj->image_url = $item['thumbnail_image'];
            return $obj;
        }, array_slice(array_values($relatedArticles), 0, 4));

        return view('articles.show', [
            'article' => $formattedArticle,
            'relatedArticles' => $formattedRelated,
        ]);
    }
}
