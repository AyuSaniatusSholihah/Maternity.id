<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $subscriptionPlans = DB::table('subscription_plans')
            ->whereIn('code', $subscriptionCodes)
            ->get(['code', 'price', 'period'])
            ->keyBy('code');
        $subscriptionCodes = $subscriptionPlans->keys()->all();

        if ($subscriptionCodes === []) {
            return;
        }

        $statuses = ['accepted', 'declined', 'hold'];

        $payments = [];
        $usedCombinations = []; // Track (code, user_id) combinations to avoid duplicates

        // Create subscription payments for each member
        foreach ($members as $index => $member) {
            // Each member gets 1-2 unique subscription codes
            $memberSubscriptionCount = rand(1, 2);
            $selectedCodes = array_slice($subscriptionCodes, 0, $memberSubscriptionCount);

            foreach ($selectedCodes as $codeIdx => $code) {
                $combinationKey = "$code-{$member->account_id}";

                // Skip if this combination already exists
                if (in_array($combinationKey, $usedCombinations)) {
                    continue;
                }

                $usedCombinations[] = $combinationKey;
                $status = $statuses[rand(0, count($statuses) - 1)];
                $startDate = now()->subMonths(rand(1, 6));

                $plan = $subscriptionPlans->get($code);

                $payments[] = [
                    'subcription_code' => $code,
                    'user_id' => $member->account_id,
                    'reviewer_id' => $status === 'accepted' ? $admin?->account_id : null,
                    'payment_status' => $status,
                    'proof_img_url' => $status === 'accepted' ? 'https://example.com/proof/bayar-'.$index.'-'.$codeIdx.'.jpg' : null,
                    'subamount' => $plan->price,
                    'voucher_id' => null,
                    'total_amount' => $plan->price,
                    'reviewed_at' => $status === 'accepted' ? $startDate : null,
                    'message' => $status === 'declined' ? 'Bukti pembayaran tidak sesuai' : null,
                    'started_at' => $startDate,
                    'ended_at' => $startDate->clone()->addMonths($plan->period),
                    'created_at' => $startDate->clone()->subDays(5),
                    'updated_at' => $startDate,
                ];
            }
        }

        // Insert all payments at once
        if (! empty($payments)) {
            DB::table('subscription_payments')->insert($payments);
        }
    }
}
