<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = Category::all();
        $admin = \App\Models\Admin::first();

        if (!$admin) {
            return;
        }

        $materials = [
            [
                'title' => 'Panduan Lengkap Kehamilan Trimester Pertama',
                'description' => 'E-book komprehensif tentang trimester pertama kehamilan.',
                'content' => 'Trimester pertama adalah periode penting. Dokter akan melakukan berbagai pemeriksaan kesehatan.',
                'category' => 'Nutrisi & Gizi',
            ],
            [
                'title' => 'Nutrisi Ibu Hamil: Resep dan Panduan',
                'description' => 'Koleksi resep bergizi khusus untuk ibu hamil.',
                'content' => 'Nutrisi seimbang adalah kunci kesehatan ibu hamil. Kebutuhan kalori meningkat 300-500 kal per hari.',
                'category' => 'Nutrisi & Gizi',
            ],
            [
                'title' => 'Persiapan Persalinan Normal: Teknik dan Meditasi',
                'description' => 'Panduan teknik pernapasan dan persiapan mental untuk persalinan normal.',
                'content' => 'Persiapan mental sangat penting untuk persalinan yang lancar. Teknik pernapasan membantu mengurangi rasa sakit.',
                'category' => 'Persalinan & Kelahiran',
            ],
            [
                'title' => 'Perawatan Bayi Baru Lahir',
                'description' => 'Panduan lengkap merawat bayi baru lahir di minggu-minggu pertama.',
                'content' => 'Bayi baru lahir memerlukan perawatan khusus. Jaga suhu tubuh bayi tetap hangat.',
                'category' => 'Perawatan Bayi',
            ],
            [
                'title' => 'Menyusui: Panduan Praktis dan Solusi Masalah',
                'description' => 'Teknik menyusui yang benar dan solusi untuk masalah umum.',
                'content' => 'Menyusui adalah cara terbaik memberikan nutrisi kepada bayi. Posisi yang benar sangat penting.',
                'category' => 'Perawatan Bayi',
            ],
            [
                'title' => 'Kesehatan Mental Ibu Hamil dan Postpartum',
                'description' => 'Informasi tentang kesehatan mental selama kehamilan dan postpartum.',
                'content' => 'Kesehatan mental sama pentingnya dengan kesehatan fisik. Perubahan hormon dapat menyebabkan mood swings.',
                'category' => 'Kesehatan Mental',
            ],
            [
                'title' => 'Olahraga dan Fitness Selama Kehamilan',
                'description' => 'Program latihan yang aman untuk ibu hamil.',
                'content' => 'Olahraga teratur selama kehamilan sangat bermanfaat. Jalan cepat adalah olahraga paling aman.',
                'category' => 'Olahraga & Kebugaran',
            ],
            [
                'title' => 'Panduan Pemeriksaan Kehamilan dan USG',
                'description' => 'Penjelasan pemeriksaan kehamilan rutin dan interpretasi hasil USG.',
                'content' => 'Pemeriksaan kehamilan rutin penting untuk memantau kesehatan ibu dan bayi setiap saat.',
                'category' => 'Pemeriksaan Medis',
            ],
        ];

        foreach ($materials as $material) {
            $category = $categories->where('name', $material['category'])->first();
            
            Material::create([
                'id' => Str::uuid(),
                'title' => $material['title'],
                'slug' => Str::slug($material['title']),
                'description' => $material['description'],
                'content' => $material['content'],
                'image_url' => null,
                'categories' => $category?->id,
                'uploaded_by' => $admin->account_id,
            ]);
        }
    }
}
