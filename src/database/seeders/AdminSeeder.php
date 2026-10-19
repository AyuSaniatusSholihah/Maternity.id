<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the admins table.
     */
    public function run(): void
    {
        // Get admin accounts
        $adminUtama = Account::where('email', 'admin@maternity.id')->first();
        $konsultan = Account::where('email', 'konsultan@maternity.id')->first();
        $pembuat = Account::where('email', 'pembuat@maternity.id')->first();

        if ($adminUtama) {
            Admin::create([
                'account_id' => $adminUtama->id,
                'name' => 'Admin Utama',
                'email' => 'admin@maternity.id',
                'phone' => '081234567890',
                'profile_img' => null,
                'role' => 'active',
            ]);
        }

        if ($konsultan) {
            Admin::create([
                'account_id' => $konsultan->id,
                'name' => 'Konsultan Kesehatan',
                'email' => 'konsultan@maternity.id',
                'phone' => '082123456789',
                'profile_img' => null,
                'role' => 'active',
            ]);
        }

        if ($pembuat) {
            Admin::create([
                'account_id' => $pembuat->id,
                'name' => 'Pembuat Konten',
                'email' => 'pembuat@maternity.id',
                'phone' => '083123456789',
                'profile_img' => null,
                'role' => 'active',
            ]);
        }
    }
}
