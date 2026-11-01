<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Member;
use Database\Seeders\SubscriptionPaymentsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SubscriptionPaymentsSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_payments_include_amounts_and_null_voucher(): void
    {
        $adminAccount = Account::create([
            'name' => 'Seeder Admin',
            'email' => 'seeder-admin@example.com',
            'role' => 'admin',
        ]);

        Admin::create([
            'account_id' => $adminAccount->id,
            'name' => $adminAccount->name,
            'email' => $adminAccount->email,
            'phone' => '081234567890',
            'role' => 'active',
        ]);

        $memberAccount = Account::create([
            'name' => 'Seeder Member',
            'email' => 'seeder-member@example.com',
            'role' => 'member',
        ]);

        Member::create([
            'account_id' => $memberAccount->id,
            'name' => $memberAccount->name,
            'email' => $memberAccount->email,
            'provisioned_by' => $adminAccount->id,
        ]);

        DB::table('subscription_plans')->insert([
            'code' => 'BASIC03',
            'name' => 'Basic Plan',
            'benefits' => 'Basic benefits',
            'price' => 49000,
            'period' => 3,
            'updated_by' => $adminAccount->id,
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        (new SubscriptionPaymentsSeeder)->run();

        $this->assertDatabaseHas('subscription_payments', [
            'subcription_code' => 'BASIC03',
            'user_id' => $memberAccount->id,
            'subamount' => 49000,
            'voucher_id' => null,
            'total_amount' => 49000,
        ]);
    }
}
