<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin accounts (5)
        $admins = [
            [
                'id' => 'a0000000-0000-0000-0000-000000000001',
                'name' => 'Admin Maternity.id',
                'email' => 'admin@maternity.id',
                'profile_img' => null,
                'account_type' => 'admin',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000002',
                'name' => 'Dr. Annisa Pratama',
                'email' => 'dr.annisa@maternity.id',
                'profile_img' => null,
                'account_type' => 'admin',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000003',
                'name' => 'Rina Sasmita',
                'email' => 'rina.sasmita@maternity.id',
                'profile_img' => null,
                'account_type' => 'admin',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000004',
                'name' => 'Bidan Kartika Sari',
                'email' => 'kartika.sari@maternity.id',
                'profile_img' => null,
                'account_type' => 'admin',
            ],
            [
                'id' => 'a0000000-0000-0000-0000-000000000005',
                'name' => 'Ahli Gizi Maternity',
                'email' => 'gizi@maternity.id',
                'profile_img' => null,
                'account_type' => 'admin',
            ],
        ];

        foreach ($admins as $admin) {
            Account::create($admin);
        }

        // Member accounts (10)
        $members = [
            [
                'id' => 'm0000000-0000-0000-0000-000000000001',
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000002',
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000003',
                'name' => 'Putri Rahayu',
                'email' => 'putri.rahayu@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000004',
                'name' => 'Agnes Widya',
                'email' => 'agnes.widya@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000005',
                'name' => 'Linda Susanti',
                'email' => 'linda.susanti@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000006',
                'name' => 'Maya Sari',
                'email' => 'maya.sari@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000007',
                'name' => 'Nurul Huda',
                'email' => 'nurul.huda@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000008',
                'name' => 'Andi Wijaya',
                'email' => 'andi.wijaya@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000009',
                'name' => 'Rina Kusuma',
                'email' => 'rina.kusuma@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
            [
                'id' => 'm0000000-0000-0000-0000-000000000010',
                'name' => 'Sari Indah',
                'email' => 'sari.indah@gmail.com',
                'profile_img' => null,
                'account_type' => 'member',
            ],
        ];

        foreach ($members as $member) {
            Account::create($member);
        }
    }
}
