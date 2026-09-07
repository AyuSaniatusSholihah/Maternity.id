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
                'assigned_at' => now()->subMonths(6)->toDateString(),
                'position' => 'maintainer',
                'number_contact' => '081234567890',
            ]);
        }

        if ($konsultan) {
            Admin::create([
                'account_id' => $konsultan->id,
                'assigned_at' => now()->subMonths(3)->toDateString(),
                'position' => 'consultant',
                'number_contact' => '082123456789',
            ]);
        }

        if ($pembuat) {
            Admin::create([
                'account_id' => $pembuat->id,
                'assigned_at' => now()->subMonth()->toDateString(),
                'position' => 'consultant',
                'number_contact' => '083123456789',
            ]);
        }
    }
}
