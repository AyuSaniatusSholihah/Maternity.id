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
                'long_description' => 'Workshop interaktif ini dirancang khusus untuk ibu hamil dan ibu menyusui yang ingin membangun ketahanan mental, membangun komunitas suportif, serta mendapatkan insight praktis dari psikolog klinis bersertifikat. Anda akan belajar teknik mindfulness, journaling reflektif, dan cara mengelola kecemasan selama masa transisi menjadi ibu.',
                'date_string' => '12 Juli 2026',
                'time_string' => '10:00 – 11:30 WIB',
                'month' => 'Jul',
                'format' => 'ONLINE',
                'format_type' => 'online',
                'location' => 'Zoom Webinar (link dikirim via email)',
                'maps_url' => null,
                'category' => 'Workshop',
                'category_slug' => 'workshop',
                'duration' => '90 menit',
                'price' => 'Gratis / Free',
                'price_numeric' => 0,
                'rating' => '4.7',
                'total_participants' => 89,
                'max_participants' => 150,
                'speaker' => 'Rina Sasmita, M.Psi., Psikolog',
                'speaker_bio' => 'Psikolog klinis berpengalaman 10 tahun di bidang kesehatan mental ibu & anak.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
                'is_verified' => true,
                'badge' => 'Segera Hadir',
            ],
            [
                'id' => '2',
                'slug' => 'holistic-hormone-health',
                'title' => 'Holistic Hormone Health',
                'description' => 'A deep dive into balancing your cycle and pregnancy hormones naturally with Dr. Jenkins & holistic midwives.',
                'long_description' => 'Seminar eksklusif membahas cara menyeimbangkan hormon kehamilan secara alami, mengatasi morning sickness, dan memahami perubahan hormonal dari trimester ke trimester. Dipresentasikan oleh dokter spesialis kandungan berpengalaman beserta tim bidan holistik.',
                'date_string' => '14 Juli 2026',
                'time_string' => '09:00 – 11:00 WIB',
                'month' => 'Jul',
                'format' => 'OFFLINE - JKT',
                'format_type' => 'offline',
                'location' => 'Maternity Wellness Hub, Jakarta Selatan',
                'maps_url' => 'https://maps.google.com/?q=Jakarta+Selatan',
                'category' => 'Seminar',
                'category_slug' => 'seminar',
                'duration' => '120 menit',
                'price' => 'Rp150.000',
                'price_numeric' => 150000,
                'rating' => '4.8',
                'total_participants' => 124,
                'max_participants' => 200,
                'speaker' => 'dr. Annisa Pratama, Sp.OG',
                'speaker_bio' => 'Dokter spesialis Obstetri & Ginekologi, praktik di RS Hermina Jaksel.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => true,
                'is_my_event' => true,
                'is_verified' => true,
                'badge' => 'Terlaris',
            ],
            [
                'id' => '3',
                'slug' => 'prenatal-yoga-for-calm-and-strength',
                'title' => 'Prenatal Yoga for Calm & Strength',
                'description' => 'Gentle movement to support you and your baby during pregnancy, opening pelvic area safely for labor.',
                'long_description' => 'Kelas yoga prenatal yang dirancang aman untuk semua trimester. Anda akan belajar gerakan gentle untuk membuka area panggul, memperkuat otot punggung, dan meningkatkan keseimbangan napas. Dipandu langsung oleh bidan bersertifikat yoga prenatal internasional.',
                'date_string' => '20 Juli 2026',
                'time_string' => '08:30 – 09:30 WIB',
                'month' => 'Jul',
                'format' => 'ONLINE',
                'format_type' => 'online',
                'location' => 'Google Meet (link dikirim via email)',
                'maps_url' => null,
                'category' => 'Kelas Yoga',
                'category_slug' => 'kelas-yoga',
                'duration' => '60 menit',
                'price' => 'Rp75.000',
                'price_numeric' => 75000,
                'rating' => '4.9',
                'total_participants' => 58,
                'max_participants' => 100,
                'speaker' => 'Bidan Kartika Sari, S.Tr.Keb',
                'speaker_bio' => 'Bidan bersertifikat yoga prenatal & postnatal, instruktur aktif di Maternity.id.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
                'is_verified' => true,
                'badge' => 'Populer',
            ],
            [
                'id' => '4',
                'slug' => 'newborn-gentle-care-and-massage',
                'title' => 'Newborn Gentle Care & Baby Massage',
                'description' => 'Praktik langsung pijat bayi untuk meredakan kolik, memperlancar tidur, dan merawat tali pusat bayi baru lahir.',
                'long_description' => 'Workshop tatap muka dengan praktik langsung pijat bayi menggunakan teknik gentle touch yang aman dan terbukti secara klinis. Peserta akan mendapatkan panduan cara memijat area perut untuk mengatasi kolik, stimulasi motorik, dan perawatan tali pusat. Setiap peserta mendapat kit minyak pijat bayi eksklusif.',
                'date_string' => '22 Juli 2026',
                'time_string' => '13:00 – 14:30 WIB',
                'month' => 'Jul',
                'format' => 'OFFLINE - SBY',
                'format_type' => 'offline',
                'location' => 'Grand City Hall, Surabaya',
                'maps_url' => 'https://maps.google.com/?q=Grand+City+Hall+Surabaya',
                'category' => 'Workshop',
                'category_slug' => 'workshop',
                'duration' => '90 menit',
                'price' => 'Rp120.000',
                'price_numeric' => 120000,
                'rating' => '4.6',
                'total_participants' => 45,
                'max_participants' => 80,
                'speaker' => 'Bidan Kartika Sari & Tim Laktasi',
                'speaker_bio' => 'Tim bidan dan konselor laktasi berpengalaman dengan spesialisasi perawatan bayi baru lahir.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
                'is_verified' => true,
                'badge' => 'Segera Hadir',
            ],
            [
                'id' => '5',
                'slug' => 'optimal-fetal-positioning-and-breathing',
                'title' => 'Optimal Fetal Positioning & Hypnobirthing',
                'description' => 'Teknik pernapasan tiup-tiup saat kontraksi dan posisi senam panggul agar persalinan lancar minim trauma.',
                'long_description' => 'Webinar gratis untuk mempersiapkan persalinan yang lebih tenang dan minim trauma. Anda akan mempelajari teknik hypnobirthing, cara mengatur posisi janin optimal, senam panggul efektif, dan teknik napas untuk menghadapi kontraksi. Rekaman tersedia 30 hari setelah acara.',
                'date_string' => '25 Juli 2026',
                'time_string' => '15:00 – 16:15 WIB',
                'month' => 'Jul',
                'format' => 'ONLINE',
                'format_type' => 'online',
                'location' => 'Zoom Webinar (link dikirim via email)',
                'maps_url' => null,
                'category' => 'Seminar',
                'category_slug' => 'seminar',
                'duration' => '75 menit',
                'price' => 'Gratis / Free',
                'price_numeric' => 0,
                'rating' => '4.8',
                'total_participants' => 201,
                'max_participants' => 500,
                'speaker' => 'Konselor Gentle Birth Maya',
                'speaker_bio' => 'Konselor gentle birth bersertifikat, fasilitator kelas hypnobirthing nasional.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
                'is_verified' => true,
                'badge' => 'Gratis',
            ],
            [
                'id' => '6',
                'slug' => 'meal-prep-nutrisi-trimester-3-and-laktasi',
                'title' => 'Meal Prep Nutrisi Trimester 3 & ASI Booster',
                'description' => 'Panduan praktis memasak menu sehat kaya zat besi, kalsium, dan galaktagog alami untuk persiapan menyusui.',
                'long_description' => 'Workshop kuliner & nutrisi tatap muka. Anda akan belajar menyiapkan 7 menu meal-prep mingguan yang kaya zat besi, kalsium, dan galaktagog alami (pelancar ASI). Dipandu oleh dokter gizi dan chef nutrisi bersertifikat. Setiap peserta membawa pulang meal prep box hasil praktek langsung.',
                'date_string' => '28 Juli 2026',
                'time_string' => '10:00 – 12:00 WIB',
                'month' => 'Jul',
                'format' => 'OFFLINE - BDG',
                'format_type' => 'offline',
                'location' => 'Dago Culinary & Health Studio, Bandung',
                'maps_url' => 'https://maps.google.com/?q=Dago+Bandung',
                'category' => 'Workshop',
                'category_slug' => 'workshop',
                'duration' => '120 menit',
                'price' => 'Rp175.000',
                'price_numeric' => 175000,
                'rating' => '4.9',
                'total_participants' => 33,
                'max_participants' => 50,
                'speaker' => 'dr. Annisa Pratama & Ahli Gizi',
                'speaker_bio' => 'Dokter gizi klinik & chef nutrisi dengan spesialisasi diet kehamilan dan laktasi.',
                'thumbnail_image' => 'https://images.unsplash.com/photo-1490818387583-1baba5e638af?auto=format&fit=crop&q=80&w=800',
                'is_bookmarked' => false,
                'is_my_event' => false,
                'is_verified' => true,
                'badge' => 'Hampir Penuh',
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
     * Tampilkan Detail Event / Checkout Pelatihan (Public Display)
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
            $event = $allEvents[0] ?? [
                'id' => '1',
                'slug' => 'mindful-motherhood',
                'title' => 'Pelatihan Yoga',
                'price' => 'Rp60.000',
            ];
        }

        return view('events.detail', [
            'event' => (object) $event,
            'relatedEvents' => array_slice(array_values(array_filter($allEvents, fn($e) => ($e['slug'] ?? '') !== $slug)), 0, 3)
        ]);
    }

    /**
     * Tampilkan Halaman Checkout / Pembayaran Event
     */
    public function checkout($slug)
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
            $event = $allEvents[0] ?? [
                'id' => '1',
                'slug' => 'mindful-motherhood',
                'title' => 'Pelatihan Yoga',
                'price' => 'Rp60.000',
                'price_numeric' => 60000,
            ];
        }

        return view('events.checkout', [
            'event' => (object) $event,
        ]);
    }

    /**
     * Tampilkan Halaman Status Verifikasi Pembayaran
     */
    public function verification($slug = 'mindful-motherhood')
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
            $event = $allEvents[0] ?? [
                'id' => '1',
                'slug' => 'mindful-motherhood',
                'title' => 'Pelatihan Yoga',
                'price' => 'Rp60.000',
            ];
        }

        return view('events.verification', [
            'event' => (object) $event,
        ]);
    }

    /**
     * Tampilkan Halaman Pendaftaran Diterima / Terverifikasi Admin
     */
    public function approved($slug = 'mindful-motherhood')
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
            $event = $allEvents[0] ?? [
                'id' => '1',
                'slug' => 'mindful-motherhood',
                'title' => 'Pelatihan Yoga',
                'price' => 'Rp60.000',
            ];
        }

        return view('events.approved', [
            'event' => (object) $event,
        ]);
    }
}
