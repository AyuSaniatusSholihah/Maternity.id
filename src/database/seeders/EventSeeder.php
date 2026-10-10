<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Event;
use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the events table.
     */
    public function run(): void
    {
        $admin = Admin::first();
        $categories = Category::all();
        $materials = Material::all();

        if (!$admin) {
            return;
        }

        $events = [
            [
                'title' => 'Persiapan Kehamilan Sehat',
                'description' => 'Workshop intensif tentang persiapan kehamilan yang sehat, nutrisi, dan gaya hidup yang tepat untuk calon ibu.',
                'event_date' => now()->addDays(7)->toDateString(),
                'open_registration_date' => now()->toDateString(),
                'close_registration_date' => now()->addDays(5)->toDateString(),
                'location' => 'Rumah Sakit Ibu dan Anak, Jakarta',
                'image_url' => null,
                'slot' => 50,
                'is_available' => true,
                'category' => 'Nutrisi & Gizi',
            ],
            [
                'title' => 'Persalinan Normal: Tips dan Persiapan',
                'description' => 'Kelas online yang membahas proses persalinan normal, teknik pernapasan, dan persiapan mental untuk persalinan.',
                'event_date' => now()->addDays(14)->toDateString(),
                'open_registration_date' => now()->toDateString(),
                'close_registration_date' => now()->addDays(10)->toDateString(),
                'location' => 'Platform Online Zoom',
                'image_url' => null,
                'slot' => 100,
                'is_available' => true,
                'category' => 'Persalinan & Kelahiran',
            ],
            [
                'title' => 'Nutrisi Optimal untuk Kehamilan',
                'description' => 'Seminar nutrisi lengkap untuk ibu hamil, mencakup kalori, protein, vitamin, dan mineral yang dibutuhkan.',
                'event_date' => now()->addDays(21)->toDateString(),
                'open_registration_date' => now()->toDateString(),
                'close_registration_date' => now()->addDays(15)->toDateString(),
                'location' => 'Pusat Kesehatan Ibu dan Anak, Bandung',
                'image_url' => null,
                'slot' => 40,
                'is_available' => true,
                'category' => 'Nutrisi & Gizi',
            ],
            [
                'title' => 'Perawatan Bayi Baru Lahir',
                'description' => 'Workshop praktis tentang cara merawat bayi baru lahir, mandi, ganti popok, dan tanda-tanda kesehatan normal.',
                'event_date' => now()->addDays(28)->toDateString(),
                'open_registration_date' => now()->toDateString(),
                'close_registration_date' => now()->addDays(20)->toDateString(),
                'location' => 'Rumah Sakit Ibu dan Anak, Surabaya',
                'image_url' => null,
                'slot' => 35,
                'is_available' => true,
                'category' => 'Perawatan Bayi',
            ],
            [
                'title' => 'Manajemen Nyeri Persalinan Alami',
                'description' => 'Kelas online interaktif membahas teknik manajemen nyeri alami saat persalinan tanpa epidural.',
                'event_date' => now()->addDays(35)->toDateString(),
                'open_registration_date' => now()->toDateString(),
                'close_registration_date' => now()->addDays(25)->toDateString(),
                'location' => 'Platform Online Zoom',
                'image_url' => null,
                'slot' => 80,
                'is_available' => false,
                'category' => 'Persalinan & Kelahiran',
            ],
            [
                'title' => 'Kesiapan Mental dan Emosional Kehamilan',
                'description' => 'Sesi konseling kelompok untuk mempersiapkan calon ibu secara mental dan emosional menghadapi perubahan hidup.',
                'event_date' => now()->addDays(42)->toDateString(),
                'open_registration_date' => now()->addDays(5)->toDateString(),
                'close_registration_date' => now()->addDays(35)->toDateString(),
                'location' => 'Klinik Kesehatan Mental, Jakarta',
                'image_url' => null,
                'slot' => 25,
                'is_available' => true,
                'category' => 'Kesehatan Mental',
            ],
        ];

        $speakers = [
            'Dr. Siti Nurhaliza, Sp.OG',
            'Dr. Budi Santoso, Sp.OG, M.Kes',
            'Bidan Dina Wijaya, S.Keb',
            'Dr. Eka Prasetyo, Sp.OG, PhD',
            'Konselor Laktasi Rini Kusuma, IBCLC',
            'Dr. Lestari Handoko, Sp.OG, M.H',
        ];

        foreach ($events as $index => $event) {
            $category = $categories->where('name', $event['category'])->first();
            
            // Vary fees: some free, some paid
            $fees = [0, 0, 50000, 75000, 100000, 150000];
            $fee = $fees[$index % count($fees)];
            
            // Rotate through speakers
            $speaker = $speakers[$index % count($speakers)];
            
            $createdEvent = Event::create([
                'id' => Str::uuid(),
                'title' => $event['title'],
                'slug' => Str::slug($event['title']),
                'description' => $event['description'],
                'event_date' => $event['event_date'],
                'open_registration_date' => $event['open_registration_date'],
                'close_registration_date' => $event['close_registration_date'],
                'location' => $event['location'],
                'image_url' => $event['image_url'],
                'slot' => $event['slot'],
                'is_available' => $event['is_available'],
                'categories' => $category?->id,
                'fee' => $fee,
                'speaker' => $speaker,
                'created_by' => $admin->account_id,
            ]);

            // Attach 2-3 random materials to each event
            if ($materials->isNotEmpty()) {
                $materialCount = rand(2, 3);
                $randomMaterials = $materials->random(min($materialCount, $materials->count()));
                $createdEvent->materials()->attach($randomMaterials->pluck('id')->toArray());
            }
        }
    }
}
