<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'account_id' => 'a0000000-0000-0000-0000-000000000001',
                'assigned_at' => '2026-01-01',
                'position' => 'maintainer',
                'number_contact' => '081234567890',
            ],
            [
                'account_id' => 'a0000000-0000-0000-0000-000000000002',
                'assigned_at' => '2026-02-15',
                'position' => 'consultant',
                'number_contact' => '081234567891',
            ],
            [
                'account_id' => 'a0000000-0000-0000-0000-000000000003',
                'assigned_at' => '2026-03-10',
                'position' => 'consultant',
                'number_contact' => '081234567892',
            ],
            [
                'account_id' => 'a0000000-0000-0000-0000-000000000004',
                'assigned_at' => '2026-04-01',
                'position' => 'consultant',
                'number_contact' => '081234567893',
            ],
            [
                'account_id' => 'a0000000-0000-0000-0000-000000000005',
                'assigned_at' => '2026-05-20',
                'position' => 'consultant',
                'number_contact' => '081234567894',
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
