<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the members table.
     */
    public function run(): void
    {
        $memberEmails = [
            'ibu.siti@email.com',
            'ibu.dina@email.com',
            'ibu.eka@email.com',
            'ibu.rini@email.com',
            'ibu.lestari@email.com',
        ];

        // Get a consultant admin for provisioning
        $provisioner = Admin::first();

        foreach ($memberEmails as $index => $email) {
            $account = Account::where('email', $email)->first();

            if ($account && $provisioner) {
                Member::create([
                    'account_id' => $account->id,
                    'name' => $account->name,
                    'email' => $email,
                    'phone' => '628120000000' . str_pad($index, 2, '0', STR_PAD_LEFT),
                    'date_of_birth' => now()->subYears(25 + $index)->toDateString(),
                    'gender' => 'W',
                    'address' => match($index) {
                        0 => 'Jl. Merdeka No. 123, Jakarta',
                        1 => 'Jl. Sudirman No. 45, Bandung',
                        2 => 'Jl. Gatot Subroto No. 67, Surabaya',
                        3 => 'Jl. Ahmad Yani No. 89, Medan',
                        4 => 'Jl. Diponegoro No. 101, Yogyakarta',
                        default => 'Alamat Tidak Tersedia',
                    },
                    'city' => match($index) {
                        0 => 'Jakarta',
                        1 => 'Bandung',
                        2 => 'Surabaya',
                        3 => 'Medan',
                        4 => 'Yogyakarta',
                        default => 'Kota Lainnya',
                    },
                    'province' => match($index) {
                        0 => 'DKI Jakarta',
                        1 => 'Jawa Barat',
                        2 => 'Jawa Timur',
                        3 => 'Sumatera Utara',
                        4 => 'DI Yogyakarta',
                        default => 'Provinsi Lainnya',
                    },
                    'image_url' => null,
                    'provisioned_by' => $provisioner->account_id,
                ]);
            }
        }
    }
}
