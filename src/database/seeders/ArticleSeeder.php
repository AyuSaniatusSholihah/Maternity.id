<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'id' => 'a0000000-0000-0000-0000-000000000001',
                'title' => 'Nutrisi Seimbang untuk Ibu Hamil',
                'keywords' => 'nutrisi ibu hamil, makanan sehat, asam folat',
                'slug' => 'nutrisi-seimbang-untuk-ibu-hamil',
                'short_description' => 'Panduan makanan sehat yang mendukung tumbuh kembang janin dan menjaga kesehatan ibu.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=400',
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
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">3. Makanan yang Dianjurkan Setiap Hari</h3>
                    <p class="text-neutral-700 leading-relaxed mb-4">Konsumsi aneka warna buah dan sayuran, ikan kaya omega-3, daging tanpa lemak, dan susu ibu hamil untuk memenuhi semua kebutuhan nutrisi.</p>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000002',
                'status' => 'published',
                'created_at' => '2026-08-15 10:00:00',
                'updated_at' => '2026-08-15 10:00:00',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000002',
                'title' => 'Cara Mengelola Stres pada Ibu Hamil',
                'keywords' => 'stres ibu hamil, kesehatan mental, meditasi',
                'slug' => 'cara-mengelola-stres-pada-ibu-hamil',
                'short_description' => 'Tips sederhana untuk menjaga kesehatan mental selama kehamilan.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&q=80&w=400',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Fluktuasi hormon kehamilan sering memicu perubahan suasana hati dan kecemasan. Relaksasi pikiran dan latihan pernapasan teratur sangat membantu menenangkan sistem saraf.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Latihan Meditasi & Relaksasi Sederhana</h3>
                    <p class="text-neutral-700 leading-relaxed mb-4">Luangkan waktu 10-15 menit di pagi hari untuk duduk tenang, mendengarkan afirmasi positif kehamilan, dan melakukan pernapasan diafragma yang dalam dan lembut.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Aktivitas Relaksasi Lainnya</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Yoga Prenatal - gerakan lembut untuk relaksasi tubuh dan pikiran</li>
                        <li>Journaling - tulis perasaan dan harapan untuk bayi</li>
                        <li>Listening Music - dengarkan musik yang menenangkan</li>
                        <li>Pijat Ibu Hamil - relaksasi tubuh bersama pasangan</li>
                    </ul>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000003',
                'status' => 'published',
                'created_at' => '2026-08-14 09:30:00',
                'updated_at' => '2026-08-14 09:30:00',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000003',
                'title' => 'Pola Tidur Bayi Baru Lahir',
                'keywords' => 'tidur bayi baru lahir, pola tidur bayi, newborn sleep',
                'slug' => 'pola-tidur-bayi-baru-lahir',
                'short_description' => 'Kenali kebutuhan tidur bayi dan cara membangun rutinitas tidur yang sehat.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=400',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Bayi baru lahir (newborn) rata-rata tidur 14-17 jam sehari dengan siklus 2-4 jam sekali bangun untuk menyusu. Kenali tanda-tanda bayi mengantuk sebelum ia over-tired.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Tanda Bayi Mengantuk</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Menggosok-gosok mata atau menarik telinga.</li>
                        <li>Menguap dan tatapan mata mulai sayu.</li>
                        <li>Gerakan tangan dan kaki mulai melambat.</li>
                        <li>Membuat suara-suara lembut atau gemuruh.</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Membangun Rutinitas Tidur</h3>
                    <p class="text-neutral-700 leading-relaxed mb-4">Ciptakan lingkungan yang tenang, gunakan popok yang nyaman, dan ajarkan bayi membedakan siang dan malam dengan pencahayaan yang berbeda.</p>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000004',
                'status' => 'published',
                'created_at' => '2026-08-12 14:00:00',
                'updated_at' => '2026-08-12 14:00:00',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000004',
                'title' => 'Minum Air Putih yang Cukup Selama Hamil',
                'keywords' => 'air putih saat hamil, hidrasi ibu hamil, kebutuhan air',
                'slug' => 'minum-air-putih-yang-cukup',
                'short_description' => 'Manfaat dan tips memenuhi kebutuhan cairan selama kehamilan.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1548839140-29a749e1bc4e?auto=format&fit=crop&q=80&w=400',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Kebutuhan cairan ibu hamil meningkat untuk mendukung pembentukan air ketuban, sirkulasi darah ekstra bagi janin, serta mencegah infeksi saluran kemih dan sembelit.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Berapa Banyak Air Putih yang Dibutuhkan?</h3>
                    <p class="text-neutral-700 leading-relaxed mb-4">Ibu hamil memerlukan minimal 8-10 gelas (2,5 - 3 liter) air putih setiap hari. Kebutuhan ini bisa meningkat jika cuaca panas atau jika Anda aktif bergerak.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Tips Hidrasi Harian</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Bawa botol minum portabel ke mana pun pergi</li>
                        <li>Minum air perlahan, jangan buru-buru</li>
                        <li>Campur air dengan irisan lemon atau buah untuk variasi</li>
                        <li>Jangan menunggu haus baru minum</li>
                    </ul>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000002',
                'status' => 'published',
                'created_at' => '2026-08-10 11:00:00',
                'updated_at' => '2026-08-10 11:00:00',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000005',
                'title' => 'Peran Suami dalam Mendampingi Kehamilan',
                'keywords' => 'suami mendampingi kehamilan, dukungan suami, ayah siaga',
                'slug' => 'peran-suami-mendampingi-kehamilan',
                'short_description' => 'Dukungan emosional dan fisik dari pasangan kunci sukses kehamilan bahagia.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?auto=format&fit=crop&q=80&w=400',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Kehamilan adalah perjalanan bersama. Kehadiran aktif suami saat kontrol kandungan, membantu pekerjaan rumah, dan memberikan pijatan lembut sangat mengurangi beban ibu.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Apa yang Bisa Dilakukan Suami?</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Mendampingi saat kontrol kandungan</li>
                        <li>Membantu pekerjaan rumah tangga yang berat</li>
                        <li>Memberikan pijatan lembut untuk relaksasi</li>
                        <li>Mendengarkan dan memberikan dukungan emosional</li>
                        <li>Belajar bersama tentang kehamilan dan persalinan</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Hindari Hal Ini</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Mengabaikan perubahan mood istri</li>
                        <li>Meninggalkan istri sendiri saat kontraksi</li>
                        <li>Mengurangi aktivitas bersama</li>
                        <li>Tidak ikut belajar tentang kehamilan</li>
                    </ul>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000003',
                'status' => 'published',
                'created_at' => '2026-08-08 16:00:00',
                'updated_at' => '2026-08-08 16:00:00',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000006',
                'title' => 'Teknik Memandikan Bayi Baru Lahir',
                'keywords' => 'memandikan bayi baru lahir, cara mandi bayi, perawatan tali pusat',
                'slug' => 'teknik-memandikan-bayi-baru-lahir',
                'short_description' => 'Langkah aman memandikan bayi dengan air hangat dan perawatan tali pusat.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1519689680058-324335c77eba?auto=format&fit=crop&q=80&w=400',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Memandikan bayi baru lahir tidak perlu lama-lama (cukup 5-10 menit). Pastikan suhu air suam-suam kuku sekitar 37°C dan keringkan tali pusat dengan kasa bersih setelah mandi.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Alat yang Dibutuhkan</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Baskom atau tempat mandi bayi</li>
                        <li>Air hangat (37°C)</li>
                        <li>Sabun bayi yang ringan</li>
                        <li>Handuk lembut dengan kapas</li>
                        <li>Pakaian bersih dan popok</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Langkah Memandikan Bayi</h3>
                    <ol class="list-decimal pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Cuci tangan dan siapkan semua perlengkapan</li>
                        <li>Baringkan bayi di permukaan yang aman</li>
                        <li>Bersihkan mata dari dalam ke luar dengan kapas basah</li>
                        <li>Cuci rambut dengan shampo bayi ringan</li>
                        <li>Masukkan bayi ke air dengan satu tangan menahan kepala</li>
                        <li>Pijat lembut tubuh bayi</li>
                        <li>Keringkan terutama lipatan kulit dan tali pusat</li>
                    </ol>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000004',
                'status' => 'published',
                'created_at' => '2026-08-05 09:00:00',
                'updated_at' => '2026-08-05 09:00:00',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000007',
                'title' => 'Variasi Buah dan Sayur Kaya Antioksidan',
                'keywords' => 'buah antioksidan, sayur untuk ibu hamil, vitamin ibu hamil',
                'slug' => 'variasi-buah-dan-sayur-kaya-antioksidan',
                'short_description' => 'Pilihan buah segar kaya vitamin untuk menjaga imunitas ibu dan perkembangan plasenta.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1490818387583-1baba5e638af?auto=format&fit=crop&q=80&w=400',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Konsumsi aneka warna buah seperti alpukat, pisang, stroberi, dan pepaya menyediakan antioksidan kuat untuk menangkal radikal bebas dan memperlancar pencernaan.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Buah-Buahan Pilihan</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li><strong>Alpukat:</strong> Kaya folat dan lemak sehat untuk perkembangan otak janin</li>
                        <li><strong>Pisang:</strong> Sumber kalium dan vitamin B6 untuk mengurangi mual</li>
                        <li><strong>Stroberi:</strong> Kaya vitamin C dan antioksidan</li>
                        <li><strong>Pepaya matang:</strong> Membantu pencernaan (hindari pepaya mentah)</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Sayuran Hijau Pilihan</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li><strong>Sayur bayam:</strong> Kaya zat besi dan asam folat</li>
                        <li><strong>Kangkung:</strong> Sumber kalsium dan zat besi</li>
                        <li><strong>Brokoli:</strong> Kaya serat dan vitamin C</li>
                        <li><strong>Kembang kol:</strong> Sumber vitamin K dan folat</li>
                    </ul>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000002',
                'status' => 'published',
                'created_at' => '2026-08-03 13:00:00',
                'updated_at' => '2026-08-03 13:00:00',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000008',
                'title' => 'Persiapan Menjelang Persalinan',
                'keywords' => 'persiapan persalinan, checklist persalinan, persalinan ibu hamil',
                'slug' => 'persiapan-menjelang-persalinan',
                'short_description' => 'Panduan lengkap mempersiapkan diri dan perlengkapan untuk persalinan.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=400',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Persiapan yang matang dan pemahaman yang tepat akan membantu ibu menjalani masa kehamilan dan persalinan dengan tenang, percaya diri, dan nyaman.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Checklist Perlengkapan untuk Ibu</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Baju bebat longgar (2-3 pcs)</li>
                        <li>Palang persalinan (untuk istirahat saat kontraksi)</li>
                        <li>Pembalut postpartum (ukuran besar)</li>
                        <li>Pakaian dalam postpartum (high-waisted, ukuran besar)</li>
                        <li>Alat kompres hangat/dingin untuk payudara</li>
                        <li>Nomor kontak darurat (dokter, bidan, rumah sakit)</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Checklist Perlengkapan untuk Bayi</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Baju bayi (3-5 pcs set)</li>
                        <li>Popok bayi (ukuran newborn)</li>
                        <li>Sprei popok dan tissue base</li>
                        <li>Topi dan kaus kaki</li>
                        <li>Ember/keranjang untuk mandi bayi</li>
                        <li>Alat hisap lendir hidung bayi</li>
                    </ul>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000004',
                'status' => 'published',
                'created_at' => '2026-07-30 10:00:00',
                'updated_at' => '2026-07-30 10:00:00',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000009',
                'title' => 'Tanda-Tanda Kontraksi Palsu dan Asli',
                'keywords' => 'kontraksi palsu, kontraksi asli, beda kontraksi',
                'slug' => 'tanda-tanda-kontraksi-palsu-dan-asli',
                'short_description' => 'Kenali perbedaan kontraksi Braxton Hicks dan kontraksi persalinan asli.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=400',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Memahami perbedaan antara kontraksi palsu (Braxton Hicks) dan kontraksi persalinan asli sangat penting agar ibu tidak panik dan bisa mengambil keputusan tepat waktu.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Kontraksi Palsu (Braxton Hicks)</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Tidak teratur, tidak ada pola waktu</li>
                        <li>Intensitas tidak meningkat</li>
                        <li>Sering berkurang saat berubah posisi</li>
                        <li>Rasa nyeri lebih di depan perut</li>
                        <li>Tidak disertai keluarnya lendir atau air ketuban</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Kontraksi Persalinan Asli</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Teratur, semakin sering dan makin dekat waktunya</li>
                        <li>Intensitas meningkat dari waktu ke waktu</li>
                        <li>Tidak berkurang saat berubah posisi</li>
                        <li>Rasa nyeri mulai dari punggung ke perut</li>
                        <li>Dapat disertai keluarnya lendir berdarah atau air ketuban</li>
                    </ul>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000004',
                'status' => 'published',
                'created_at' => '2026-07-28 15:00:00',
                'updated_at' => '2026-07-28 15:00:00',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000010',
                'title' => 'Tips Menjaga Kesehatan Ibu Setelah Persalinan',
                'keywords' => 'postpartum, perawatan pasca persalinan, kesehatan ibu nifas',
                'slug' => 'tips-menjaga-kesehatan-ibu-setelah-persalinan',
                'short_description' => 'Panduan lengkap merawat diri dan memulihkan kekuatan setelah melahirkan.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=400',
                'content' => '
                    <p class="lead text-lg font-medium text-[#5C4542] leading-relaxed mb-6">Masa nifas (6 minggu setelah persalinan) adalah waktu penting untuk pemulihan tubuh. Perawatan yang baik akan mempercepat penyembuhan dan meningkatkan kualitas ASI.</p>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Nutrisi Masa Nifas</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Konsumsi makanan bergizi tinggi dan mudah dicerna</li>
                        <li>Minum air putih cukup (8-10 gelas/hari)</li>
                        <li>Konsumsi makanan yang mengandung zat besi tinggi</li>
                        <li>Hindari makanan terlalu pedas atau berlemak tinggi</li>
                    </ul>
                    
                    <h3 class="text-xl font-bold text-[#2A1614] mt-8 mb-4">Perawatan Luka Persalinan</h3>
                    <ul class="list-disc pl-6 space-y-2 text-neutral-700 mb-6">
                        <li>Jaga kebersihan area genital dengan pencucian yang benar</li>
                        <li>Ganti pembalut secara teratur (setiap 4-6 jam)</li>
                        <li>Hindari angkat berat minimal 6 minggu</li>
                        <li>Konsultasi jika ada tanda infeksi (demam, nanah, bau notan)</li>
                    </ul>
                ',
                'author_id' => 'a0000000-0000-0000-0000-000000000004',
                'status' => 'published',
                'created_at' => '2026-07-25 11:00:00',
                'updated_at' => '2026-07-25 11:00:00',
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
