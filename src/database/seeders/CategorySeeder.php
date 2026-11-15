<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the categories table.
     */
    public function run(): void
    {
        $categories = [
            'Nutrisi & Gizi',
            'Kesehatan Mental',
            'Olahraga & Kebugaran',
            'Persalinan & Kelahiran',
            'Perawatan Bayi',
            'Gejala & Tanda',
            'Perubahan Tubuh',
            'Pemeriksaan Medis',
            'Keamanan & Bahaya',
            'Gaya Hidup',
            'Pertumbuhan Remaja',
            'Pranikah & Prakonsepsi',
            'Kehamilan',
            'Persiapan Persalinan',
            'Bayi Baru Lahir',
            'Menyusui',
            'Makanan Bayi',
            'Pola Asuh',
        ];

        foreach ($categories as $category) {
            Category::create([
                'id' => Str::uuid(),
                'name' => $category,
                'slug' => Str::slug($category),
                'description' => 'Kategori: ' . $category,
            ]);
        }
    }
}
