<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Event;
use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MaterialSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the materials table.
     */
    public function run(): void
    {
        $admin = Admin::first();
        $event = Event::first();

        if (!$admin || !$event) {
            return;
        }

        $materials = [
            [
                'title' => 'Panduan Lengkap Kehamilan Trimester Pertama',
                'description' => 'E-book komprehensif yang mencakup semua informasi penting untuk trimester pertama kehamilan Anda.',
                'content_link' => 'https://example.com/ebooks/trimester-pertama.pdf',
            ],
            [
                'title' => 'Nutrisi Ibu Hamil: Resep dan Panduan Lengkap',
                'description' => 'Koleksi resep bergizi khusus untuk ibu hamil dengan panduan nutrisi yang detail.',
                'content_link' => 'https://example.com/ebooks/nutrisi-ibu-hamil.pdf',
            ],
            [
                'title' => 'Persiapan Persalinan Normal: Teknik dan Meditasi',
                'description' => 'Panduan praktis tentang teknik pernapasan, meditasi, dan persiapan mental untuk persalinan normal.',
                'content_link' => 'https://example.com/ebooks/persiapan-persalinan.pdf',
            ],
            [
                'title' => 'Perawatan Bayi Baru Lahir: Panduan Orang Tua Baru',
                'description' => 'Panduan lengkap untuk memahami dan merawat bayi baru lahir di minggu-minggu pertama.',
                'content_link' => 'https://example.com/ebooks/perawatan-bayi.pdf',
            ],
            [
                'title' => 'Menyusui: Panduan Praktis dan Solusi Masalah',
                'description' => 'E-book berisi teknik menyusui yang benar, tips, dan solusi untuk masalah umum menyusui.',
                'content_link' => 'https://example.com/ebooks/panduan-menyusui.pdf',
            ],
            [
                'title' => 'Kesehatan Mental Ibu Hamil dan Postpartum',
                'description' => 'Informasi penting tentang kesehatan mental selama kehamilan dan masa postpartum.',
                'content_link' => 'https://example.com/ebooks/kesehatan-mental-ibu.pdf',
            ],
            [
                'title' => 'Olahraga dan Fitness Selama Kehamilan',
                'description' => 'Program latihan yang aman dan efektif untuk ibu hamil dengan video tutorial.',
                'content_link' => 'https://example.com/ebooks/olahraga-hamil.pdf',
            ],
            [
                'title' => 'Panduan Pemeriksaan Kehamilan dan USG',
                'description' => 'Penjelasan lengkap tentang pemeriksaan kehamilan rutin dan interpretasi hasil USG.',
                'content_link' => 'https://example.com/ebooks/pemeriksaan-kehamilan.pdf',
            ],
        ];

        foreach ($materials as $index => $material) {
            Material::create([
                'title' => $material['title'],
                'slug' => Str::slug($material['title']),
                'description' => $material['description'],
                'content_link' => $material['content_link'],
                'thumbnail_image' => null,
                'viewer_count' => rand(10, 500),
                'event_id' => $event->id,
                'uploaded_by' => $admin->account_id,
            ]);
        }
    }
}
