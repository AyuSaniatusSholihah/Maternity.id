<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Data kurasi Event & Kelas Maternity.id
     */
    private function getCuratedEvents()
    {
        return [
            [
                'id' => '1',
                'slug' => 'mindful-motherhood',
                'title' => 'Mindful Motherhood',
                'description' => 'Building mental resilience and community during early parenting stages with certified maternal psychologists.',
                'date_string' => '12 Juli 2026',
                'time_string' => '10:00 WIB',
                'month' => 'Jul',
                'format' => 'ONLINE',
                'format_type' => 'online',
                'category' => 'Workshop',
                'category_slug' => 'workshop',
                'duration' => '90 menit',
                'price' => 'Gratis / Free',
                'speaker' => 'Rina Sasmita, M.Psi., Psikolog',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
            ],
            [
                'id' => '2',
                'slug' => 'holistic-hormone-health',
                'title' => 'Holistic Hormone Health',
                'description' => 'A deep dive into balancing your cycle and pregnancy hormones naturally with Dr. Jenkins & holistic midwives.',
                'date_string' => '14 Juli 2026',
                'time_string' => '09:00 WIB',
                'month' => 'Jul',
                'format' => 'OFFLINE - JKT',
                'format_type' => 'offline',
                'location' => 'Maternity Wellness Hub Jakarta Selatan',
                'category' => 'Seminar',
                'category_slug' => 'seminar',
                'duration' => '120 menit',
                'price' => 'Rp 150.000',
                'speaker' => 'dr. Annisa Pratama, Sp.OG',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => true,
                'is_my_event' => true,
            ],
            [
                'id' => '3',
                'slug' => 'prenatal-yoga-for-calm-and-strength',
                'title' => 'Prenatal Yoga for Calm & Strength',
                'description' => 'Gentle movement to support you and your baby during pregnancy, opening pelvic area safely for labor.',
                'date_string' => '20 Juli 2026',
                'time_string' => '08:30 WIB',
                'month' => 'Jul',
                'format' => 'ONLINE',
                'format_type' => 'online',
                'category' => 'Kelas Yoga',
                'category_slug' => 'kelas-yoga',
                'duration' => '60 menit',
                'price' => 'Rp 75.000',
                'speaker' => 'Bidan Kartika Sari, S.Tr.Keb',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
            ],
            [
                'id' => '4',
                'slug' => 'newborn-gentle-care-and-massage',
                'title' => 'Newborn Gentle Care & Baby Massage',
                'description' => 'Praktik langsung pijat bayi untuk meredakan kolik, memperlancar tidur, dan merawat tali pusat bayi baru lahir.',
                'date_string' => '22 Juli 2026',
                'time_string' => '13:00 WIB',
                'month' => 'Jul',
                'format' => 'OFFLINE - SBY',
                'format_type' => 'offline',
                'location' => 'Grand City Hall Surabaya',
                'category' => 'Workshop',
                'category_slug' => 'workshop',
                'duration' => '90 menit',
                'price' => 'Rp 120.000',
                'speaker' => 'Bidan Kartika Sari & Tim Laktasi',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
            ],
            [
                'id' => '5',
                'slug' => 'optimal-fetal-positioning-and-breathing',
                'title' => 'Optimal Fetal Positioning & Hypnobirthing',
                'description' => 'Teknik pernapasan tiup-tiup saat kontraksi dan posisi senam panggul agar persalinan lancar minim trauma.',
                'date_string' => '25 Juli 2026',
                'time_string' => '15:00 WIB',
                'month' => 'Jul',
                'format' => 'ONLINE',
                'format_type' => 'online',
                'category' => 'Seminar',
                'category_slug' => 'seminar',
                'duration' => '75 menit',
                'price' => 'Gratis / Free',
                'speaker' => 'Konselor Gentle Birth Maya',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
            ],
            [
                'id' => '6',
                'slug' => 'meal-prep-nutrisi-trimester-3-and-laktasi',
                'title' => 'Meal Prep Nutrisi Trimester 3 & ASI Booster',
                'description' => 'Panduan praktis memasak menu sehat kaya zat besi, kalsium, dan galaktagog alami untuk persiapan menyusui.',
                'date_string' => '28 Juli 2026',
                'time_string' => '10:00 WIB',
                'month' => 'Jul',
                'format' => 'OFFLINE - BDG',
                'format_type' => 'offline',
                'location' => 'Dago Culinary & Health Studio Bandung',
                'category' => 'Workshop',
                'category_slug' => 'workshop',
                'duration' => '120 menit',
                'price' => 'Rp 175.000',
                'speaker' => 'dr. Annisa Pratama & Ahli Gizi',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1490818387583-1baba5e638af?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
            ]
        ];
    }

    /**
     * Tampilkan Halaman Katalog Event & Kelas
     */
    public function index(Request $request)
    {
        $allEvents = $this->getCuratedEvents();
        $month = $request->input('month', 'Jul');
        $tab = $request->input('tab', 'all'); // 'all' or 'my'
        $category = $request->input('category', 'all');

        $events = $allEvents;

        // Filter tab: 'my' events
        if ($tab === 'my') {
            $events = array_filter($events, function ($e) {
                return !empty($e['is_my_event']);
            });
        }

        // Filter category
        if ($category && $category !== 'all') {
            $events = array_filter($events, function ($e) use ($category) {
                return $e['category_slug'] === $category;
            });
        }

        // Filter month
        if ($month && $month !== 'all') {
            $events = array_filter($events, function ($e) use ($month) {
                return $e['month'] === $month;
            });
        }

        $months = [
            ['code' => 'Jan', 'name' => 'Jan'],
            ['code' => 'Feb', 'name' => 'Feb'],
            ['code' => 'Mar', 'name' => 'Mar'],
            ['code' => 'Apr', 'name' => 'Apr'],
            ['code' => 'Mei', 'name' => 'Mei'],
            ['code' => 'Jun', 'name' => 'Jun'],
            ['code' => 'Jul', 'name' => 'Jul'],
            ['code' => 'Agu', 'name' => 'Agu'],
            ['code' => 'Sep', 'name' => 'Sep'],
            ['code' => 'Okt', 'name' => 'Okt'],
            ['code' => 'Nov', 'name' => 'Nov'],
            ['code' => 'Des', 'name' => 'Des'],
        ];

        $categories = [
            ['slug' => 'all', 'name' => 'Semua Kategori'],
            ['slug' => 'workshop', 'name' => 'Workshop'],
            ['slug' => 'seminar', 'name' => 'Seminar'],
            ['slug' => 'kelas-yoga', 'name' => 'Kelas Yoga'],
        ];

        return view('events.index', [
            'events' => array_values($events),
            'months' => $months,
            'currentMonth' => $month,
            'currentTab' => $tab,
            'currentCategory' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Tampilkan Detail Event / Workshop
     */
    public function show($slug)
    {
        $allEvents = $this->getCuratedEvents();
        $event = null;

        foreach ($allEvents as $item) {
            if ($item['slug'] === $slug) {
                $event = $item;
                break;
            }
        }

        if (!$event) {
            abort(404, 'Event tidak ditemukan.');
        }

        return view('events.show', [
            'event' => (object) $event,
            'relatedEvents' => array_slice(array_values(array_filter($allEvents, fn($e) => $e['slug'] !== $slug)), 0, 3)
        ]);
    }
}
