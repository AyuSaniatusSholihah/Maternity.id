<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
                'id' => 'm0000000-0000-0000-0000-000000000001',
                'event_id' => 'e0000000-0000-0000-0000-000000000001',
                'title' => 'Panduan Mindful Motherhood',
                'slug' => 'panduan-mindful-motherhood',
                'description' => 'E-book lengkap tentang mindfulness untuk ibu hamil dan ibu muda.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=400',
                'content_link' => 'https://drive.google.com/file/d/1mindful_ebook/view',
                'viewer_count' => 150,
                'uploaded_by' => 'a0000000-0000-0000-0000-000000000003',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000002',
                'event_id' => 'e0000000-0000-0000-0000-000000000002',
                'title' => 'Hormone Balance Guide',
                'slug' => 'hormone-balance-guide',
                'description' => 'Panduan menyeimbangkan hormon kehamilan secara alami.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=400',
                'content_link' => 'https://drive.google.com/file/d/1hormone_ebook/view',
                'viewer_count' => 120,
                'uploaded_by' => 'a0000000-0000-0000-0000-000000000002',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000003',
                'event_id' => 'e0000000-0000-0000-0000-000000000003',
                'title' => 'Panduan Yoga Prenatal',
                'slug' => 'panduan-yoga-prenatal',
                'description' => 'Gerakan yoga aman untuk ibu hamil di setiap trimester.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=400',
                'content_link' => 'https://drive.google.com/file/d/1yoga_ebook/view',
                'viewer_count' => 200,
                'uploaded_by' => 'a0000000-0000-0000-0000-000000000004',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000004',
                'event_id' => 'e0000000-0000-0000-0000-000000000004',
                'title' => 'Newborn Care Manual',
                'slug' => 'newborn-care-manual',
                'description' => 'Panduan lengkap perawatan bayi baru lahir dan pijat bayi.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=400',
                'content_link' => 'https://drive.google.com/file/d/1newborn_ebook/view',
                'viewer_count' => 180,
                'uploaded_by' => 'a0000000-0000-0000-0000-000000000004',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000005',
                'event_id' => 'e0000000-0000-0000-0000-000000000005',
                'title' => 'Hypnobirthing untuk Persalinan Tenang',
                'slug' => 'hypnobirthing-untuk-persalinan-tenang',
                'description' => 'Teknik pernapasan dan relaksasi untuk persalinan yang lebih mudah.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=400',
                'content_link' => 'https://drive.google.com/file/d/1hypno_ebook/view',
                'viewer_count' => 250,
                'uploaded_by' => 'a0000000-0000-0000-0000-000000000003',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000006',
                'event_id' => 'e0000000-0000-0000-0000-000000000006',
                'title' => 'Meal Prep Trimester Ketiga',
                'slug' => 'meal-prep-trimester-ketiga',
                'description' => 'Resep-resep sehat untuk persiapan persalinan dan menyusui.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1490818387583-1baba5e638af?auto=format&fit=crop&q=80&w=400',
                'content_link' => 'https://drive.google.com/file/d/1meal_ebook/view',
                'viewer_count' => 175,
                'uploaded_by' => 'a0000000-0000-0000-0000-000000000002',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000007',
                'event_id' => 'e0000000-0000-0000-0000-000000000007',
                'title' => 'Panduan Laktasi Lengkap',
                'slug' => 'panduan-laktasi-lengkap',
                'description' => 'Panduan lengkap menyusui dan perawatan payudara.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=400',
                'content_link' => 'https://drive.google.com/file/d/1laktasi_ebook/view',
                'viewer_count' => 300,
                'uploaded_by' => 'a0000000-0000-0000-0000-000000000004',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000008',
                'event_id' => null,
                'title' => 'Kesehatan Mental Ibu Hamil',
                'slug' => 'kesehatan-mental-ibu-hamil',
                'description' => 'Panduan menjaga kesehatan mental selama kehamilan.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&q=80&w=400',
                'content_link' => 'https://drive.google.com/file/d/1mental_ebook/view',
                'viewer_count' => 220,
                'uploaded_by' => 'a0000000-0000-0000-0000-000000000003',
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
