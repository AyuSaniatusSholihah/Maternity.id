<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventRegistrationSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the event_registration table.
     */
    public function run(): void
    {
        $events = Event::all();
        $members = Member::all();
        $admin = Admin::first();

        if ($events->isEmpty() || $members->isEmpty()) {
            return;
        }

        $statuses = ['accepted', 'declined', 'hold', 'blocked'];

        $registrations = [];
        $eventIndex = 0;

        // Create registrations for members across events
        foreach ($members as $memberIndex => $member) {
            // Register each member for 2-3 events
            $eventCount = rand(2, 3);
            for ($i = 0; $i < $eventCount; $i++) {
                $event = $events->get($eventIndex % $events->count());
                $status = $statuses[rand(0, 2)]; // Mostly accepted/hold/declined
                
                $registrations[] = [
                    'event_id' => $event->id,
                    'user_id' => $member->id,
                    'reviewer_id' => $admin?->account_id,
                    'payment_status' => $status,
                    'proof_img_url' => $status === 'accepted' ? 'https://example.com/proof/bukti-' . $memberIndex . '.jpg' : null,
                    'reviewed_at' => $status === 'accepted' ? now()->subDays(rand(1, 30)) : null,
                    'message' => $status === 'declined' ? 'Bukti pembayaran tidak jelas' : null,
                    'created_at' => now()->subDays(rand(1, 60)),
                    'updated_at' => now()->subDays(rand(0, 30)),
                ];
                
                $eventIndex++;
            }
        }

        // Chunk insertions to avoid memory issues
        foreach (array_chunk($registrations, 100) as $chunk) {
            DB::table('event_registration')->insert($chunk);
        }
    }
}
