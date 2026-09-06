<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the admin (should be created by AdminSeeder)
        $admin = Admin::first();
        $adminId = $admin ? $admin->account_id : null;

        // Generate 10 dummy materials
        $materials = [];

        $titles = [
            'Panduan Mindful Motherhood',
            'Hormone Balance Guide',
            'Panduan Yoga Prenatal',
            'Newborn Care Manual',
            'Hypnobirthing untuk Persalinan Tenang',
            'Meal Prep Trimester Ketiga',
            'Panduan Laktasi Lengkap',
            'Kesehatan Mental Ibu Hamil',
            'Panduan Persalinan Alami',
            'Tips Menyusui yang Benar',
        ];

        $slugs = [
            'panduan-mindful-motherhood',
            'hormone-balance-guide',
            'panduan-yoga-prenatal',
            'newborn-care-manual',
            'hypnobirthing-untuk-persalinan-tenang',
            'meal-prep-trimester-ketiga',
            'panduan-laktasi-lengkap',
            'kesehatan-mental-ibu-hamil',
            'panduan-persalinan-alami',
            'tips-menyusui-yang-benar',
        ];

        $descriptions = [
            'E-book lengkap tentang mindfulness untuk ibu hamil dan ibu muda.',
            'Panduan menyeimbangkan hormon kehamilan secara alami.',
            'Gerakan yoga aman untuk ibu hamil di setiap trimester.',
            'Panduan lengkap perawatan bayi baru lahir dan pijat bayi.',
            'Teknik pernapasan dan relaksasi untuk persalinan yang lebih mudah.',
            'Resep-resep sehat untuk persiapan persalinan dan menyusui.',
            'Panduan lengkap menyusui dan perawatan payudara.',
            'Panduan menjaga kesehatan mental selama kehamilan.',
            'Panduan komprehensif untuk persalinan alami yang aman.',
            'Tips dan trik menyusui yang benar untuk ibu baru.',
        ];

        $thumbnails = [
            'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1490818387583-1baba5e638af?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1516979137511-6b836815e097?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1522312346375-d1a52e2b93b1?auto=format&fit=crop&q=80&w=400',
            'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&q=80&w=400',
        ];

        $contentLinks = [
            'https://drive.google.com/file/d/1mindful_ebook/view',
            'https://drive.google.com/file/d/1hormone_ebook/view',
            'https://drive.google.com/file/d/1yoga_ebook/view',
            'https://drive.google.com/file/d/1newborn_ebook/view',
            'https://drive.google.com/file/d/1hypno_ebook/view',
            'https://drive.google.com/file/d/1meal_ebook/view',
            'https://drive.google.com/file/d/1laktasi_ebook/view',
            'https://drive.google.com/file/d/1mental_ebook/view',
            'https://drive.google.com/file/d/1persalinan_ebook/view',
            'https://drive.google.com/file/d/1menyusui_ebook/view',
        ];

        for ($i = 0; $i < 10; $i++) {
            $materials[] = [
                'id' => 'm0000000-0000-0000-0000-00000000000' . ($i + 1),
                'title' => $titles[$i],
                'slug' => $slugs[$i],
                'description' => $descriptions[$i],
                'thumbnail_image' => $thumbnails[$i],
                'content_link' => $contentLinks[$i],
                'viewer_count' => random_int(100, 300),
                'uploaded_by' => $adminId,
            ];
        }

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
