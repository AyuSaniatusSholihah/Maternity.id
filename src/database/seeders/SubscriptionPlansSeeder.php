<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionPlansSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the subscription_plans table.
     */
    public function run(): void
    {
        $admin = Admin::first();

        if (!$admin) {
            return;
        }

        $plans = [
            [
                'code' => 'BASIC03',
                'name' => 'Basic Plan',
                'benefits' => 'Akses artikel terbatas, newsletter mingguan, komunitas member',
                'price' => 49000,
                'period' => 1,
            ],
            [
                'code' => 'PREM06',
                'name' => 'Premium 6 Bulan',
                'benefits' => 'Akses artikel unlimited, kelas online, konsultasi bulanan, sertifikat',
                'price' => 249000,
                'period' => 6,
            ],
            [
                'code' => 'PREM12',
                'name' => 'Premium 1 Tahun',
                'benefits' => 'Akses artikel unlimited, kelas online unlimited, konsultasi bulanan, sertifikat, diskon produk',
                'price' => 449000,
                'period' => 12,
            ],
            [
                'code' => 'ELITE01',
                'name' => 'Elite Monthly',
                'benefits' => 'VIP akses semua fitur, konsultasi pribadi, video coaching, merchandise eksklusif',
                'price' => 199000,
                'period' => 1,
            ],
            [
                'code' => 'ELITE12',
                'name' => 'Elite Annual',
                'benefits' => 'VIP akses semua fitur, unlimited konsultasi pribadi, video coaching, merchandise eksklusif, event khusus',
                'price' => 1999000,
                'period' => 12,
            ],
            [
                'code' => 'FAMILY3',
                'name' => 'Family Plan (3 orang)',
                'benefits' => 'Akses unlimited untuk 3 orang, kelas online, konsultasi keluarga, diskon produk',
                'price' => 549000,
                'period' => 3,
            ],
        ];

        foreach ($plans as $plan) {
            DB::table('subscription_plans')->insert([
                'code' => $plan['code'],
                'name' => $plan['name'],
                'benefits' => $plan['benefits'],
                'price' => $plan['price'],
                'period' => $plan['period'],
                'updated_by' => $admin->account_id,
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }
    }
}
