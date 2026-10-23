<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'id' => Str::uuid(),
            'name' => 'Admin Utama',
            'email' => 'admin@maternity.id',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => null,
        ]);

        Account::create([
            'id' => Str::uuid(),
            'name' => 'Konsultan Kesehatan',
            'email' => 'konsultan@maternity.id',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => null,
        ]);

        Account::create([
            'id' => Str::uuid(),
            'name' => 'Pembuat Konten',
            'email' => 'pembuat@maternity.id',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => null,
        ]);

        // Member accounts
        Account::create([
            'id' => Str::uuid(),
            'name' => 'Ibu Siti Nurhaliza',
            'email' => 'ibu.siti@email.com',
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => null,
        ]);

        Account::create([
            'id' => Str::uuid(),
            'name' => 'Ibu Dina Putri',
            'email' => 'ibu.dina@email.com',
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => null,
        ]);

        Account::create([
            'id' => Str::uuid(),
            'name' => 'Ibu Eka Wijaya',
            'email' => 'ibu.eka@email.com',
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => null,
        ]);

        Account::create([
            'id' => Str::uuid(),
            'name' => 'Ibu Rini Kusuma',
            'email' => 'ibu.rini@email.com',
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => null,
        ]);

        Account::create([
            'id' => Str::uuid(),
            'name' => 'Ibu Lestari Handoko',
            'email' => 'ibu.lestari@email.com',
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => null,
        ]);
    }
}
