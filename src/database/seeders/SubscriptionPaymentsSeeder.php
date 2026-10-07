<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubscriptionPaymentsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the subscription_payments table.
     */
    public function run(): void
    {
        $members = Member::all();
        $admin = Admin::first();

        if ($members->isEmpty()) {
            return;
        }

        $subscriptionCodes = ['BASIC03', 'PREM06', 'PREM12', 'ELITE01', 'ELITE12'];
        $statuses = ['accepted', 'declined', 'hold'];

        $payments = [];
        $usedCombinations = []; // Track (code, user_id) combinations to avoid duplicates

        // Create subscription payments for each member
        foreach ($members as $index => $member) {
            // Each member gets 1-2 unique subscription codes
            $memberSubscriptionCount = rand(1, 2);
            $selectedCodes = array_slice($subscriptionCodes, 0, $memberSubscriptionCount);
            
            foreach ($selectedCodes as $codeIdx => $code) {
                $combinationKey = "$code-{$member->id}";
                
                // Skip if this combination already exists
                if (in_array($combinationKey, $usedCombinations)) {
                    continue;
                }
                
                $usedCombinations[] = $combinationKey;
                $status = $statuses[rand(0, count($statuses) - 1)];
                $startDate = now()->subMonths(rand(1, 6));
                
                // Determine period based on code
                $period = match ($code) {
                    'BASIC03' => 1,
                    'PREM06' => 6,
                    'PREM12' => 12,
                    'ELITE01' => 1,
                    'ELITE12' => 12,
                    default => 1,
                };
                
                $payments[] = [
                    'subcription_code' => $code,
                    'user_id' => $member->id,
                    'reviewer_id' => $status === 'accepted' ? $admin?->account_id : null,
                    'payment_status' => $status,
                    'proof_img_url' => $status === 'accepted' ? 'https://example.com/proof/bayar-' . $index . '-' . $codeIdx . '.jpg' : null,
                    'reviewed_at' => $status === 'accepted' ? $startDate : null,
                    'message' => $status === 'declined' ? 'Bukti pembayaran tidak sesuai' : null,
                    'started_at' => $startDate,
                    'ended_at' => $startDate->clone()->addMonths($period),
                    'created_at' => $startDate->clone()->subDays(5),
                    'updated_at' => $startDate,
                ];
            }
        }

        // Insert all payments at once
        if (!empty($payments)) {
            DB::table('subscription_payments')->insert($payments);
        }
    }
}
