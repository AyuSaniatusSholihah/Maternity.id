<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the accounts table.
     */
    public function run(): void
    {
        // Admin accounts
        Account::create([
            'email' => 'admin@maternity.id',
            'name' => 'Admin Utama',
            'profile_img' => null,
            'account_type' => 'admin',
        ]);

        Account::create([
            'email' => 'konsultan@maternity.id',
            'name' => 'Konsultan Kesehatan',
            'profile_img' => null,
            'account_type' => 'admin',
        ]);

        Account::create([
            'email' => 'pembuat@maternity.id',
            'name' => 'Pembuat Konten',
            'profile_img' => null,
            'account_type' => 'admin',
        ]);

        // Member accounts
        Account::create([
            'email' => 'ibu.siti@email.com',
            'name' => 'Ibu Siti Nurhaliza',
            'profile_img' => null,
            'account_type' => 'member',
        ]);

        Account::create([
            'email' => 'ibu.dina@email.com',
            'name' => 'Ibu Dina Putri',
            'profile_img' => null,
            'account_type' => 'member',
        ]);

        Account::create([
            'email' => 'ibu.eka@email.com',
            'name' => 'Ibu Eka Wijaya',
            'profile_img' => null,
            'account_type' => 'member',
        ]);

        Account::create([
            'email' => 'ibu.rini@email.com',
            'name' => 'Ibu Rini Kusuma',
            'profile_img' => null,
            'account_type' => 'member',
        ]);

        Account::create([
            'email' => 'ibu.lestari@email.com',
            'name' => 'Ibu Lestari Handoko',
            'profile_img' => null,
            'account_type' => 'member',
        ]);
    }
}
