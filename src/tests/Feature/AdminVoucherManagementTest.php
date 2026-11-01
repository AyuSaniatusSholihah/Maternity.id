<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminVoucherManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_voucher_list_counts_services_and_redemptions(): void
    {
        [$admin, $event, $planCode, $voucherId] = $this->createVoucherFixtures();
        $member = $this->createMember($admin);
        $this->attachVoucher($voucherId, $event->id, 'events');
        $this->attachVoucher($voucherId, $planCode, 'subscription_plans');
        $this->createEventRegistration($event->id, $member, $admin, $voucherId);
        $this->createSubscriptionPayment($planCode, $member, $admin, $voucherId);

        $this->actingAs($admin)
            ->get(route('admin.voucher'))
            ->assertOk()
            ->assertSee('Manajemen Voucher')
            ->assertSee('Jumlah Layanan')
            ->assertSee('Maks. Diskon')
            ->assertSee('Sisa Penukaran')
            ->assertSee('2')
            ->assertSee('3')
            ->assertSee('5');
    }

    public function test_admin_can_create_voucher_for_events_and_subscription_plans(): void
    {
        [$admin, $event, $planCode] = $this->createVoucherFixtures();

        $this->actingAs($admin)
            ->get(route('admin.voucher.create'))
            ->assertOk()
            ->assertSee('Tambah Voucher')
            ->assertSee($event->title)
            ->assertSee($planCode)
            ->assertSee('Cari dan pilih beberapa event...')
            ->assertSee('name="events[]"', false)
            ->assertDontSee('type="checkbox" name="events[]"', false)
            ->assertSee('type="checkbox" name="subscription_plans[]"', false);

        $this->actingAs($admin)
            ->post(route('admin.voucher.store'), [
                'maximum_discount' => 75000,
                'discount' => 20,
                'is_usable' => '1',
                'valid_from' => '2026-11-01T10:00',
                'valid_until' => '2026-12-01T23:59',
                'max_redem' => 12,
                'events' => [$event->id],
                'subscription_plans' => [$planCode],
            ])
            ->assertRedirect(route('admin.voucher'));

        $voucher = DB::table('vouchers')
            ->where('created_by', $admin->id)
            ->where('maximum_discount', 75000)
            ->first();
        $this->assertNotNull($voucher);
        $this->assertSame(20.0, (float) $voucher->discount);
        $this->assertDatabaseHas('associated_voucher', [
            'voucher_id' => $voucher->id,
            'item_id' => $event->id,
            'item_type' => 'events',
        ]);
        $this->assertDatabaseHas('associated_voucher', [
            'voucher_id' => $voucher->id,
            'item_id' => $planCode,
            'item_type' => 'subscription_plans',
        ]);
    }

    private function createVoucherFixtures(): array
    {
        $adminAccount = Account::create([
            'name' => 'Voucher Admin',
            'email' => 'voucher-admin@example.com',
            'role' => 'admin',
        ]);

        Admin::create([
            'account_id' => $adminAccount->id,
            'name' => $adminAccount->name,
            'email' => $adminAccount->email,
            'phone' => '081234567890',
            'role' => 'active',
        ]);

        $category = Category::create([
            'id' => (string) Str::uuid(),
            'name' => 'Voucher Category',
            'slug' => 'voucher-category',
            'description' => 'Test category',
        ]);

        $event = Event::create([
            'categories' => $category->id,
            'title' => 'Voucher Event',
            'slug' => 'voucher-event',
            'description' => 'Test event',
            'event_date' => '2026-12-01',
            'open_registration_date' => '2026-11-01',
            'close_registration_date' => '2026-11-30',
            'location' => 'Jakarta',
            'slot' => 30,
            'fee' => 100000,
            'speaker' => 'Test Speaker',
            'created_by' => $adminAccount->id,
        ]);

        $planCode = 'BASIC03';
        DB::table('subscription_plans')->insert([
            'code' => $planCode,
            'name' => 'Basic Plan',
            'benefits' => 'Basic benefits',
            'price' => 49000,
            'period' => 3,
            'updated_by' => $adminAccount->id,
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        $voucherId = (string) Str::uuid();
        DB::table('vouchers')->insert([
            'id' => $voucherId,
            'maximum_discount' => 50000,
            'discount' => 10,
            'is_usable' => true,
            'valid_from' => '2026-11-01 00:00:00',
            'valid_until' => '2026-12-01 23:59:00',
            'max_redem' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => $adminAccount->id,
        ]);

        return [$adminAccount, $event, $planCode, $voucherId];
    }

    private function createMember(Account $admin): string
    {
        $account = Account::create([
            'name' => 'Voucher Member',
            'email' => 'voucher-member@example.com',
            'role' => 'member',
        ]);

        DB::table('members')->insert([
            'account_id' => $account->id,
            'name' => $account->name,
            'email' => $account->email,
            'provisioned_by' => $admin->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $account->id;
    }

    private function attachVoucher(string $voucherId, string $itemId, string $itemType): void
    {
        DB::table('associated_voucher')->insert([
            'voucher_id' => $voucherId,
            'item_id' => $itemId,
            'item_type' => $itemType,
        ]);
    }

    private function createEventRegistration(string $eventId, string $memberId, Account $admin, string $voucherId): void
    {
        DB::table('event_registration')->insert([
            'event_id' => $eventId,
            'user_id' => $memberId,
            'reviewer_id' => $admin->id,
            'payment_status' => 'accepted',
            'voucher_id' => $voucherId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function createSubscriptionPayment(string $planCode, string $memberId, Account $admin, string $voucherId): void
    {
        DB::table('subscription_payments')->insert([
            'subcription_code' => $planCode,
            'user_id' => $memberId,
            'reviewer_id' => $admin->id,
            'payment_status' => 'accepted',
            'subamount' => 49000,
            'voucher_id' => $voucherId,
            'total_amount' => 44100,
            'started_at' => now(),
            'ended_at' => now()->addMonths(3),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
