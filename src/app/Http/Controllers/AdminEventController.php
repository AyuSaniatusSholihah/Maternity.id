<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminEventController extends Controller
{
    public function index(): View
    {
        $registrationCounts = DB::table('event_registration')
            ->select('event_id', DB::raw('COUNT(*) as total'))
            ->groupBy('event_id')
            ->pluck('total', 'event_id');

        $events = Event::query()
            ->with('category')
            ->latest('event_date')
            ->get()
            ->map(fn (Event $event): array => [
                'id' => $event->id,
                'title' => $event->title,
                'category' => $event->category?->name ?? 'Tanpa kategori',
                'categoryColor' => 'bg-[#FAF5F2] text-[#8C433C]',
                'month' => $event->event_date->format('Y-m'),
                'monthLabel' => $event->event_date->format('F Y'),
                'date' => $event->event_date->translatedFormat('d M Y'),
                'registrationPeriod' => $event->open_registration_date->format('d M Y') . ' - ' . $event->close_registration_date->format('d M Y'),
                'location' => $event->location,
                'speaker' => $event->speaker,
                'price' => $event->fee > 0 ? 'Rp ' . number_format($event->fee, 0, ',', '.') : 'Gratis',
                'quota' => $event->slot,
                'registered' => (int) ($registrationCounts[$event->id] ?? 0),
                'status' => $event->is_available ? 'open' : 'closed',
                'posterUrl' => $event->image_url ?: 'https://images.unsplash.com/photo-1544005313-94ddf0287e6c?auto=format&fit=crop&q=80&w=400',
            ])
            ->values();

        return view('admin.dashboard', [
            'adminEvents' => $events,
            'adminCategories' => Category::query()->orderBy('name')->get(['id', 'name']),
            'adminEventMonths' => $events->unique('month')->values(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'categories' => ['required', 'uuid', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'event_date' => ['required', 'date'],
            'open_registration_date' => ['required', 'date'],
            'close_registration_date' => ['required', 'date', 'after_or_equal:open_registration_date'],
            'location' => ['required', 'string', 'max:255'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'slot' => ['required', 'integer', 'min:1'],
            'fee' => ['required', 'integer', 'min:0'],
            'speaker' => ['required', 'string', 'max:255'],
        ]);

        Event::create([
            ...$validated,
            'slug' => str($validated['title'])->slug()->value(),
            'created_by' => $request->user()->id,
        ]);

        return redirect()
            ->route('admin.event')
            ->with('status', 'Event berhasil ditambahkan.');
    }
}