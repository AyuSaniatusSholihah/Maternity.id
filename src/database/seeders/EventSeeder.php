<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Event;
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

        if (!$admin) {
            return;
        }

        $events = [
            [
                'name' => 'Persiapan Kehamilan Sehat',
                'mentor_name' => 'Dr. Siti Nurhaliza, Sp.OG',
                'description' => 'Workshop intensif tentang persiapan kehamilan yang sehat, nutrisi, dan gaya hidup yang tepat untuk calon ibu.',
                'poster_img' => null,
                'date' => now()->addDays(7)->toDateString(),
                'location' => 'Rumah Sakit Ibu dan Anak, Jakarta',
                'venue' => 'offline',
                'status' => 'published',
                'is_available' => true,
                'price' => 250000,
                'gc_invitation_link' => 'https://meet.google.com/preparation-1',
            ],
            [
                'name' => 'Persalinan Normal: Tips dan Persiapan',
                'mentor_name' => 'Dr. Bambang Suwanto, Sp.OG',
                'description' => 'Kelas online yang membahas proses persalinan normal, teknik pernapasan, dan persiapan mental untuk persalinan.',
                'poster_img' => null,
                'date' => now()->addDays(14)->toDateString(),
                'location' => 'Platform Online Zoom',
                'venue' => 'online',
                'status' => 'published',
                'is_available' => true,
                'price' => 150000,
                'gc_invitation_link' => 'https://meet.google.com/persalinan-normal',
            ],
            [
                'name' => 'Nutrisi Optimal untuk Kehamilan',
                'mentor_name' => 'Dr. Endang Sutrisna, S.Gz',
                'description' => 'Seminar nutrisi lengkap untuk ibu hamil, mencakup kalori, protein, vitamin, dan mineral yang dibutuhkan.',
                'poster_img' => null,
                'date' => now()->addDays(21)->toDateString(),
                'location' => 'Pusat Kesehatan Ibu dan Anak, Bandung',
                'venue' => 'offline',
                'status' => 'published',
                'is_available' => true,
                'price' => 200000,
                'gc_invitation_link' => 'https://meet.google.com/nutrisi-kehamilan',
            ],
            [
                'name' => 'Perawatan Bayi Baru Lahir',
                'mentor_name' => 'Ibu Hartini, Bidan Profesional',
                'description' => 'Workshop praktis tentang cara merawat bayi baru lahir, mandi, ganti popok, dan tanda-tanda kesehatan normal.',
                'poster_img' => null,
                'date' => now()->addDays(28)->toDateString(),
                'location' => 'Rumah Sakit Ibu dan Anak, Surabaya',
                'venue' => 'offline',
                'status' => 'published',
                'is_available' => true,
                'price' => 180000,
                'gc_invitation_link' => 'https://meet.google.com/perawatan-bayi',
            ],
            [
                'name' => 'Manajemen Nyeri Persalinan Alami',
                'mentor_name' => 'Dr. Lisda Widya, Sp.OG',
                'description' => 'Kelas online interaktif membahas teknik manajemen nyeri alami saat persalinan tanpa epidural.',
                'poster_img' => null,
                'date' => now()->addDays(35)->toDateString(),
                'location' => 'Platform Online Zoom',
                'venue' => 'online',
                'status' => 'draft',
                'is_available' => false,
                'price' => 120000,
                'gc_invitation_link' => 'https://meet.google.com/manajemen-nyeri',
            ],
            [
                'name' => 'Kesiapan Mental dan Emosional Kehamilan',
                'mentor_name' => 'Dr. Psikolog Rini Kartini',
                'description' => 'Sesi konseling kelompok untuk mempersiapkan calon ibu secara mental dan emosional menghadapi perubahan hidup.',
                'poster_img' => null,
                'date' => now()->addDays(42)->toDateString(),
                'location' => 'Klinik Kesehatan Mental, Jakarta',
                'venue' => 'offline',
                'status' => 'published',
                'is_available' => true,
                'price' => 300000,
                'gc_invitation_link' => 'https://meet.google.com/kesiapan-mental',
            ],
        ];

        foreach ($events as $event) {
            Event::create([
                'name' => $event['name'],
                'slug' => Str::slug($event['name']),
                'mentor_name' => $event['mentor_name'],
                'description' => $event['description'],
                'poster_img' => $event['poster_img'],
                'date' => $event['date'],
                'location' => $event['location'],
                'venue' => $event['venue'],
                'status' => $event['status'],
                'is_available' => $event['is_available'],
                'price' => $event['price'],
                'gc_invitation_link' => $event['gc_invitation_link'],
                'created_by' => $admin->account_id,
            ]);
        }
    }
}
