<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
        
        // Fetch all events from database
        $allEventsQuery = Event::all();
        
        // Transform database events to match view structure
        $allEvents = $allEventsQuery->map(function ($event) use ($fallbackImage, $monthMap) {
            $englishMonth = $event->event_date ? $event->event_date->format('M') : 'Jan';
            $indonesianMonth = $monthMap[$englishMonth] ?? 'Jan';
            
            // Format price with Indonesian Rupiah (IDR) if fee > 0
            $priceDisplay = $event->fee > 0 ? 'Rp ' . number_format($event->fee, 0, ',', '.') : 'Gratis';
            
            return [
                'id' => $event->id,
                'slug' => $event->slug,
                'title' => $event->title,
                'description' => $event->description,
                'date_string' => $event->event_date ? $event->event_date->format('d M Y') : 'Jadwal Terbuka',
                'time_string' => '',
                'month' => $indonesianMonth,
                'format' => $event->categories === 'online' ? 'ONLINE' : 'OFFLINE',
                'format_type' => $event->categories,
                'location' => $event->location,
                'category' => ucfirst($event->categories),
                'category_slug' => $event->categories,
                'duration' => '',
                'price' => $priceDisplay,
                'price_numeric' => $event->fee,
                'thumbnail_image' => $event->image_url ?? $fallbackImage,
                'is_bookmarked' => false,
                'is_my_event' => false,
                'is_verified' => true,
                'badge' => $event->is_available ? 'Tersedia' : 'Penuh',
            ];
        })->toArray();

        $month = $request->input('month', 'all');
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

        $events = collect(array_values($events));
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $events = new LengthAwarePaginator(
            $events->forPage($currentPage, 9)->values(),
            $events->count(),
            9,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

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

        $categories = collect([
            ['slug' => 'online', 'name' => 'Online'],
            ['slug' => 'offline', 'name' => 'Offline'],
        ])
            ->prepend(['slug' => 'all', 'name' => 'Semua Kategori'])
            ->values()
            ->all();

        return view('events.index', [
            'events' => $events,
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

        // If event not found, return a 404 view with redirect
        if (!$event) {
            return view('events.not-found', ['slug' => $slug]);
        }

        // Format price with Indonesian Rupiah (IDR) if fee > 0
        $priceDisplay = $event->fee > 0 ? 'Rp ' . number_format($event->fee, 0, ',', '.') : 'Gratis';
        
        $eventData = [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->title,
            'description' => $event->description,
            'long_description' => $event->description,
            'date_string' => $event->event_date ? $event->event_date->format('d M Y') : 'Jadwal Terbuka',
            'time_string' => '',
            'price' => $priceDisplay,
            'price_numeric' => $event->fee,
            'thumbnail_image' => $event->image_url ?? $fallbackImage,
            'location' => $event->location,
            'date' => $event->event_date,
            'venue' => $event->categories,
            'format_type' => $event->categories,
            'format' => strtoupper($event->categories),
            'mentor_name' => null,
            'speaker' => $event->speaker,
            'speaker_bio' => null,
            'is_verified' => true,
            'badge' => $event->is_available ? 'Tersedia' : 'Penuh',
            'total_participants' => $event->slot ?? 0,
            'max_participants' => $event->slot ?? 0,
            'maps_url' => null,
            'registration_closed' => $event->close_registration_date
                ? now()->startOfDay()->greaterThan($event->close_registration_date) || session('registration_closed', false)
                : (bool) session('registration_closed', false),
            'payment_status' => Auth::check()
                ? DB::table('event_registration')
                    ->where('event_id', $event->id)
                    ->where('user_id', Auth::id())
                    ->value('payment_status')
                : null,
        ];

        $relatedEvents = Event::where('id', '!=', $event->id)
            ->limit(3)
            ->get()
            ->map(function ($e) use ($fallbackImage) {
                $priceDisplay = $e->fee > 0 ? 'Rp ' . number_format($e->fee, 0, ',', '.') : 'Gratis';
                return [
                    'slug' => $e->slug,
                    'title' => $e->title,
                    'description' => $e->description,
                    'price' => $priceDisplay,
                    'thumbnail_image' => $e->image_url ?? $fallbackImage,
                    'format_type' => null,
                    'date_string' => $e->event_date ? $e->event_date->format('d M Y') : 'Jadwal Terbuka',
                    'format' => 'EVENT',
                    'category' => 'Event',
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
            $event = Event::first();
        }

        if (!$event) {
            return redirect()->route('events');
        }

        if ($event->close_registration_date
            && now()->startOfDay()->greaterThan($event->close_registration_date)) {
            return redirect()->route('events.show', $event->slug)
                ->with('registration_closed', true);
        }

        $priceDisplay = $event->fee > 0 ? 'Rp ' . number_format($event->fee, 0, ',', '.') : 'Gratis';

        $eventData = [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->title,
            'description' => $event->description,
            'price' => $priceDisplay,
            'price_numeric' => $event->fee,
            'thumbnail_image' => $event->image_url ?? $fallbackImage,
            'registration_closed' => false,
            'payment_status' => Auth::check()
                ? DB::table('event_registration')
                    ->where('event_id', $event->id)
                    ->where('user_id', Auth::id())
                    ->value('payment_status')
                : null,
        ];

        return view('events.checkout', [
            'event' => (object) $eventData,
        ]);
    }

    public function submitPaymentProof(Request $request, string $slug): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('status', 'Silakan login terlebih dahulu untuk mengirim bukti pembayaran.');
        }

        $event = Event::query()->where('slug', $slug)->firstOrFail();

        if ($event->close_registration_date
            && now()->startOfDay()->greaterThan($event->close_registration_date)) {
            return redirect()->route('events.show', $event->slug)
                ->with('registration_closed', true);
        }

        $validated = $request->validate([
            'payment_proof' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'],
            'name' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:20'],
            'birth_date' => ['required', 'date'],
        ]);

        $account = $request->user();
        $proofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        DB::transaction(function () use ($account, $event, $validated, $proofPath): void {
            Member::query()->updateOrCreate(
                ['account_id' => $account->id],
                [
                    'name' => $validated['name'],
                    'email' => $account->email,
                    'phone' => $validated['whatsapp'],
                    'date_of_birth' => $validated['birth_date'] ?? null,
                ],
            );

            $existingProof = DB::table('event_registration')
                ->where('event_id', $event->id)
                ->where('user_id', $account->id)
                ->value('proof_img_url');

            DB::table('event_registration')->updateOrInsert(
                [
                    'event_id' => $event->id,
                    'user_id' => $account->id,
                ],
                [
                    'payment_status' => 'pending',
                    'proof_img_url' => $proofPath,
                    'reviewer_id' => null,
                    'reviewed_at' => null,
                    'message' => 'Bukti pembayaran menunggu verifikasi admin.',
                    'updated_at' => now(),
                    'created_at' => now(),
                ],
            );

            if ($existingProof && $existingProof !== $proofPath) {
                Storage::disk('public')->delete($existingProof);
            }
        });

        $adminEmails = DB::table('accounts')
            ->where('role', 'admin')
            ->whereNotNull('email')
            ->pluck('email');

        foreach ($adminEmails as $adminEmail) {
            try {
                Mail::raw(
                    "Ada bukti pembayaran baru yang perlu diverifikasi.\n\n"
                    ."Peserta: {$validated['name']}\n"
                    ."Email: {$account->email}\n"
                    ."Event: {$event->title}\n\n"
                    .'Silakan buka dashboard admin untuk memeriksa dan memprosesnya.',
                    fn ($mail) => $mail->to($adminEmail)
                        ->subject('Bukti Pembayaran Baru - Maternity.id')
                );
            } catch (\Throwable $exception) {
                Log::error('Gagal mengirim email notifikasi admin.', [
                    'admin_email' => $adminEmail,
                    'event_id' => $event->id,
                    'user_id' => $account->id,
                    'error' => $exception->getMessage(),
                ]);
            }
        }

        return redirect()
            ->route('events.checkout', ['slug' => $event->slug, 'step' => 4])
            ->with('status', 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.');
    }

    /**
     * Tampilkan Halaman Status Verifikasi Pembayaran
     */
    public function verification($slug = null)
    {
        $fallbackImage = config('app.fallback_image_url');
        
        if (!$slug) {
            $event = Event::first();
            $slug = $event?->slug ?? 'event';
        }

        $event = Event::where('slug', $slug)->first();

        if (!$event) {
            $event = Event::first();
        }

        if (!$event) {
            return redirect()->route('events');
        }

        $priceDisplay = $event->fee > 0 ? 'Rp ' . number_format($event->fee, 0, ',', '.') : 'Gratis';

        $eventData = [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->title,
            'description' => $event->description,
            'price' => $priceDisplay,
            'thumbnail_image' => $event->image_url ?? $fallbackImage,
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
            $event = Event::first();
            $slug = $event?->slug ?? 'event';
        }

        $event = Event::where('slug', $slug)->first();

        if (!$event) {
            $event = Event::first();
        }

        if (!$event) {
            return redirect()->route('events');
        }

        $priceDisplay = $event->fee > 0 ? 'Rp ' . number_format($event->fee, 0, ',', '.') : 'Gratis';

        $eventData = [
            'id' => $event->id,
            'slug' => $event->slug,
            'title' => $event->title,
            'description' => $event->description,
            'price' => $priceDisplay,
            'thumbnail_image' => $event->image_url ?? $fallbackImage,
        ];

        return view('events.approved', [
            'event' => (object) $eventData,
        ]);
    }
}
