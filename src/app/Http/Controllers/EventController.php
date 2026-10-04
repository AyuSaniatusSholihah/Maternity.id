<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Tampilkan Halaman Katalog Event & Kelas
     */
    public function index(Request $request)
    {
        $fallbackImage = config('app.fallback_image_url');
        
        // Month name mapping from English (format('M')) to Indonesian codes
        $monthMap = [
            'Jan' => 'Jan',
            'Feb' => 'Feb',
            'Mar' => 'Mar',
            'Apr' => 'Apr',
            'May' => 'Mei',
            'Jun' => 'Jun',
            'Jul' => 'Jul',
            'Aug' => 'Agu',
            'Sep' => 'Sep',
            'Oct' => 'Okt',
            'Nov' => 'Nov',
            'Dec' => 'Des',
        ];
        
        // Fetch only published events from database
        $allEventsQuery = Event::where('status', 'published')->get();
        
        // Transform database events to match view structure
        $allEvents = $allEventsQuery->map(function ($event) use ($fallbackImage, $monthMap) {
            $englishMonth = $event->date ? $event->date->format('M') : 'Jan';
            $indonesianMonth = $monthMap[$englishMonth] ?? 'Jan';
            
            return [
                'id' => $event->id,
                'slug' => $event->slug,
                'title' => $event->name,
                'description' => $event->description,
                'date_string' => $event->date ? $event->date->format('d M Y') : 'Jadwal Terbuka',
                'time_string' => '',
                'month' => $indonesianMonth,
                'format' => $event->venue === 'online' ? 'ONLINE' : 'OFFLINE',
                'format_type' => $event->venue,
                'location' => $event->location,
                'category' => 'Event',
                'category_slug' => 'event',
                'duration' => '',
                'price' => $event->price > 0 ? 'Rp' . number_format($event->price, 0, ',', '.') : 'Gratis',
                'price_numeric' => $event->price,
                'thumbnail_image' => $event->poster_img ?? $fallbackImage,
                'is_bookmarked' => false,
                'is_my_event' => false,
                'is_verified' => true,
                'badge' => $event->is_available ? 'Tersedia' : 'Penuh',
            ];
        })->toArray();

        $month = $request->input('month', 'Jul');
        $tab = $request->input('tab', 'all');
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
        $fallbackImage = config('app.fallback_image_url');
        
        $event = Event::where('slug', $slug)->first();

        if (!$event) {
            $event = Event::where('status', 'published')->first() ?? Event::first();
        }

        if (!$event) {
            return redirect()->route('events');
        }

        $eventData = [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->name,
            'description' => $event->description,
            'price' => $event->price > 0 ? 'Rp' . number_format($event->price, 0, ',', '.') : 'Gratis',
            'price_numeric' => $event->price,
            'thumbnail_image' => $event->poster_img ?? $fallbackImage,
            'location' => $event->location,
            'date' => $event->date,
            'venue' => $event->venue,
        ];

        $relatedEvents = Event::where('status', 'published')
            ->where('id', '!=', $event->id)
            ->limit(3)
            ->get()
            ->map(function ($e) use ($fallbackImage) {
                return [
                    'slug' => $e->slug,
                    'title' => $e->name,
                    'description' => $e->description,
                    'price' => $e->price > 0 ? 'Rp' . number_format($e->price, 0, ',', '.') : 'Gratis',
                    'thumbnail_image' => $e->poster_img ?? $fallbackImage,
                ];
            })->toArray();

        return view('events.detail', [
            'event' => (object) $eventData,
            'relatedEvents' => $relatedEvents
        ]);
    }

    /**
     * Tampilkan Halaman Checkout / Pembayaran Event
     */
    public function checkout($slug)
    {
        $fallbackImage = config('app.fallback_image_url');
        
        $event = Event::where('slug', $slug)->first();

        if (!$event) {
            $event = Event::where('status', 'published')->first() ?? Event::first();
        }

        if (!$event) {
            return redirect()->route('events');
        }

        $eventData = [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->name,
            'description' => $event->description,
            'price' => $event->price > 0 ? 'Rp' . number_format($event->price, 0, ',', '.') : 'Gratis',
            'price_numeric' => $event->price,
            'thumbnail_image' => $event->poster_img ?? $fallbackImage,
        ];

        return view('events.checkout', [
            'event' => (object) $eventData,
        ]);
    }

    /**
     * Tampilkan Halaman Status Verifikasi Pembayaran
     */
    public function verification($slug = null)
    {
        $fallbackImage = config('app.fallback_image_url');
        
        if (!$slug) {
            $event = Event::where('status', 'published')->first() ?? Event::first();
            $slug = $event?->slug ?? 'event';
        }

        $event = Event::where('slug', $slug)->first();

        if (!$event) {
            $event = Event::where('status', 'published')->first() ?? Event::first();
        }

        if (!$event) {
            return redirect()->route('events');
        }

        $eventData = [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->name,
            'description' => $event->description,
            'price' => $event->price > 0 ? 'Rp' . number_format($event->price, 0, ',', '.') : 'Gratis',
            'thumbnail_image' => $event->poster_img ?? $fallbackImage,
        ];

        return view('events.verification', [
            'event' => (object) $eventData,
        ]);
    }

    /**
     * Tampilkan Halaman Pendaftaran Diterima / Terverifikasi Admin
     */
    public function approved($slug = null)
    {
        $fallbackImage = config('app.fallback_image_url');
        
        if (!$slug) {
            $event = Event::where('status', 'published')->first() ?? Event::first();
            $slug = $event?->slug ?? 'event';
        }

        $event = Event::where('slug', $slug)->first();

        if (!$event) {
            $event = Event::where('status', 'published')->first() ?? Event::first();
        }

        if (!$event) {
            return redirect()->route('events');
        }

        $eventData = [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->name,
            'description' => $event->description,
            'price' => $event->price > 0 ? 'Rp' . number_format($event->price, 0, ',', '.') : 'Gratis',
            'thumbnail_image' => $event->poster_img ?? $fallbackImage,
        ];

        return view('events.approved', [
            'event' => (object) $eventData,
        ]);
    }
}
