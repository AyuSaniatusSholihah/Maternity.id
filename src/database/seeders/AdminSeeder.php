<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Account;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Select one random member account and make them an admin
        $randomMember = Account::where('account_type', 'member')->inRandomOrder()->first();

        if ($randomMember) {
            Admin::create([
                'account_id' => $randomMember->id,
                'assigned_at' => now()->format('Y-m-d'),
                'position' => 'consultant',
                'number_contact' => '081234567890',
            ]);

            // Update the account to be an admin
            $randomMember->update(['account_type' => 'admin']);
        }
    }
}
