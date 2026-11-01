<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminVoucherController extends Controller
{
    public function index(): View
    {
        $vouchers = DB::table('vouchers')
            ->orderByDesc('created_at')
            ->get();

        $serviceCounts = DB::table('associated_voucher')
            ->select('voucher_id', DB::raw('COUNT(*) as total'))
            ->groupBy('voucher_id')
            ->pluck('total', 'voucher_id');

        $subscriptionRedemptions = DB::table('subscription_payments')
            ->select('voucher_id', DB::raw('COUNT(*) as total'))
            ->whereNotNull('voucher_id')
            ->groupBy('voucher_id')
            ->pluck('total', 'voucher_id');

        $eventRedemptions = DB::table('event_registration')
            ->select('voucher_id', DB::raw('COUNT(*) as total'))
            ->whereNotNull('voucher_id')
            ->groupBy('voucher_id')
            ->pluck('total', 'voucher_id');

        $vouchers = $vouchers->values()->map(function (object $voucher, int $index) use (
            $serviceCounts,
            $subscriptionRedemptions,
            $eventRedemptions,
        ): array {
            $redeemed = (int) ($subscriptionRedemptions[$voucher->id] ?? 0)
                + (int) ($eventRedemptions[$voucher->id] ?? 0);

            return [
                'number' => $index + 1,
                'id' => $voucher->id,
                'service_count' => (int) ($serviceCounts[$voucher->id] ?? 0),
                'discount' => $voucher->discount,
                'maximum_discount' => $voucher->maximum_discount,
                'valid_from' => $voucher->valid_from,
                'valid_until' => $voucher->valid_until,
                'remaining_redemptions' => max(0, (int) $voucher->max_redem - $redeemed),
                'max_redemptions' => (int) $voucher->max_redem,
                'is_usable' => (bool) $voucher->is_usable,
            ];
        });

        return view('admin.dashboard', [
            'adminVouchers' => $vouchers,
        ]);
    }

    public function create(): View
    {
        return view('admin.vouchers.create', [
            'events' => Event::query()->orderBy('title')->get(['id', 'title']),
            'subscriptionPlans' => DB::table('subscription_plans')
                ->orderBy('name')
                ->get(['code', 'name', 'price']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'maximum_discount' => ['nullable', 'integer', 'min:0'],
            'discount' => ['required', 'numeric', 'gt:0', 'lte:100'],
            'is_usable' => ['required', 'boolean'],
            'valid_from' => ['required', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'max_redem' => ['required', 'integer', 'min:0'],
            'events' => ['nullable', 'array'],
            'events.*' => ['uuid', 'distinct', 'exists:events,id'],
            'subscription_plans' => ['nullable', 'array'],
            'subscription_plans.*' => ['string', 'distinct', 'exists:subscription_plans,code'],
        ]);

        DB::transaction(function () use ($validated, $request): void {
            $voucherId = (string) Str::uuid();
            $now = now();

            DB::table('vouchers')->insert([
                'id' => $voucherId,
                'maximum_discount' => $validated['maximum_discount'] ?? null,
                'discount' => $validated['discount'],
                'is_usable' => $validated['is_usable'],
                'valid_from' => $validated['valid_from'],
                'valid_until' => $validated['valid_until'] ?? null,
                'max_redem' => $validated['max_redem'],
                'created_at' => $now,
                'updated_at' => $now,
                'created_by' => $request->user()->getAuthIdentifier(),
            ]);

            $associations = [];

            foreach ($validated['events'] ?? [] as $eventId) {
                $associations[] = [
                    'voucher_id' => $voucherId,
                    'item_id' => $eventId,
                    'item_type' => 'events',
                ];
            }

            foreach ($validated['subscription_plans'] ?? [] as $planCode) {
                $associations[] = [
                    'voucher_id' => $voucherId,
                    'item_id' => $planCode,
                    'item_type' => 'subscription_plans',
                ];
            }

            if ($associations !== []) {
                DB::table('associated_voucher')->insert($associations);
            }
        });

        return redirect()
            ->route('admin.voucher')
            ->with('status', 'Voucher berhasil ditambahkan.');
    }
}
