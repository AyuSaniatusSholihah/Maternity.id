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
            'voucher' => null,
            'selectedEvents' => [],
            'selectedSubscriptionPlans' => [],
        ]);
    }

    public function show(string $id): View
    {
        $voucher = DB::table('vouchers')
            ->leftJoin('admins', 'vouchers.created_by', '=', 'admins.account_id')
            ->leftJoin('accounts', 'admins.account_id', '=', 'accounts.id')
            ->where('vouchers.id', $id)
            ->select('vouchers.*', 'accounts.name as creator_name', 'accounts.email as creator_email')
            ->first();

        abort_if($voucher === null, 404);

        $associations = DB::table('associated_voucher')
            ->where('voucher_id', $id)
            ->get();

        $eventIds = $associations->where('item_type', 'events')->pluck('item_id');
        $planCodes = $associations->where('item_type', 'subscription_plans')->pluck('item_id');

        $events = Event::query()
            ->whereIn('id', $eventIds)
            ->orderBy('title')
            ->get(['id', 'title', 'slug', 'event_date', 'fee']);

        $subscriptionPlans = DB::table('subscription_plans')
            ->whereIn('code', $planCodes)
            ->orderBy('name')
            ->get(['code', 'name', 'price', 'period']);

        $eventRegistrations = DB::table('event_registration')
            ->join('events', 'event_registration.event_id', '=', 'events.id')
            ->join('members', 'event_registration.user_id', '=', 'members.account_id')
            ->leftJoin('accounts', 'members.account_id', '=', 'accounts.id')
            ->where('event_registration.voucher_id', $id)
            ->select(
                'events.title as service_name',
                'accounts.name as member_name',
                'accounts.email as member_email',
                'event_registration.payment_status',
                'event_registration.created_at',
            )
            ->orderByDesc('event_registration.created_at')
            ->get();

        $subscriptionPayments = DB::table('subscription_payments')
            ->join('subscription_plans', 'subscription_payments.subcription_code', '=', 'subscription_plans.code')
            ->join('members', 'subscription_payments.user_id', '=', 'members.account_id')
            ->leftJoin('accounts', 'members.account_id', '=', 'accounts.id')
            ->where('subscription_payments.voucher_id', $id)
            ->select(
                'subscription_plans.name as service_name',
                'subscription_plans.code as service_code',
                'accounts.name as member_name',
                'accounts.email as member_email',
                'subscription_payments.payment_status',
                'subscription_payments.subamount',
                'subscription_payments.total_amount',
                'subscription_payments.created_at',
            )
            ->orderByDesc('subscription_payments.created_at')
            ->get();

        return view('admin.vouchers.show', [
            'voucher' => $voucher,
            'events' => $events,
            'subscriptionPlans' => $subscriptionPlans,
            'eventRegistrations' => $eventRegistrations,
            'subscriptionPayments' => $subscriptionPayments,
        ]);
    }

    public function edit(string $id): View
    {
        $voucher = DB::table('vouchers')->where('id', $id)->first();
        abort_if($voucher === null, 404);

        $associations = DB::table('associated_voucher')->where('voucher_id', $id)->get();

        return view('admin.vouchers.create', [
            'events' => Event::query()->orderBy('title')->get(['id', 'title']),
            'subscriptionPlans' => DB::table('subscription_plans')
                ->orderBy('name')
                ->get(['code', 'name', 'price']),
            'voucher' => $voucher,
            'selectedEvents' => $associations->where('item_type', 'events')->pluck('item_id')->all(),
            'selectedSubscriptionPlans' => $associations->where('item_type', 'subscription_plans')->pluck('item_id')->all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateVoucher($request);

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

            $this->syncAssociations($voucherId, $validated);
        });

        return redirect()
            ->route('admin.voucher')
            ->with('status', 'Voucher berhasil ditambahkan.');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $voucher = DB::table('vouchers')->where('id', $id)->first();
        abort_if($voucher === null, 404);

        $validated = $this->validateVoucher($request);

        DB::transaction(function () use ($id, $validated): void {
            DB::table('vouchers')->where('id', $id)->update([
                'maximum_discount' => $validated['maximum_discount'] ?? null,
                'discount' => $validated['discount'],
                'is_usable' => $validated['is_usable'],
                'valid_from' => $validated['valid_from'],
                'valid_until' => $validated['valid_until'] ?? null,
                'max_redem' => $validated['max_redem'],
                'updated_at' => now(),
            ]);

            $this->syncAssociations($id, $validated);
        });

        return redirect()
            ->route('admin.voucher.show', $id)
            ->with('status', 'Voucher berhasil diperbarui.');
    }

    public function toggle(string $id): RedirectResponse
    {
        $voucher = DB::table('vouchers')->where('id', $id)->first();
        abort_if($voucher === null, 404);

        DB::table('vouchers')->where('id', $id)->update([
            'is_usable' => ! $voucher->is_usable,
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.voucher.show', $id)
            ->with('status', $voucher->is_usable ? 'Voucher dinonaktifkan.' : 'Voucher diaktifkan.');
    }

    public function destroy(string $id): RedirectResponse
    {
        abort_unless(DB::table('vouchers')->where('id', $id)->exists(), 404);

        DB::transaction(function () use ($id): void {
            DB::table('event_registration')->where('voucher_id', $id)->update(['voucher_id' => null]);
            DB::table('subscription_payments')->where('voucher_id', $id)->update(['voucher_id' => null]);
            DB::table('associated_voucher')->where('voucher_id', $id)->delete();
            DB::table('vouchers')->where('id', $id)->delete();
        });

        return redirect()
            ->route('admin.voucher')
            ->with('status', 'Voucher berhasil dihapus.');
    }

    private function validateVoucher(Request $request): array
    {
        return $request->validate([
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
    }

    private function syncAssociations(string $voucherId, array $validated): void
    {
        DB::table('associated_voucher')->where('voucher_id', $voucherId)->delete();

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
    }
}
