<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000001',
                'salutation' => 'Ibu',
                'gender' => 'female',
                'birth_date' => '1992-05-15',
                'date_of_pregnancy' => '2026-12-25',
                'phone_number' => '081234567890',
                'address' => 'Jl. Merdeka No. 123, Surakarta',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000001',
            ],
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000002',
                'salutation' => 'Bunda',
                'gender' => 'female',
                'birth_date' => '1990-08-22',
                'date_of_pregnancy' => '2026-11-10',
                'phone_number' => '081234567891',
                'address' => 'Jl. Ahmad Yani No. 45, Jogja',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000002',
            ],
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000003',
                'salutation' => 'Mbak',
                'gender' => 'female',
                'birth_date' => '1995-03-10',
                'date_of_pregnancy' => null,
                'phone_number' => '081234567892',
                'address' => 'Jl. Pahlawan No. 67, Surakarta',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000001',
            ],
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000004',
                'salutation' => 'Ibu',
                'gender' => 'female',
                'birth_date' => '1988-11-05',
                'date_of_pregnancy' => '2026-10-15',
                'phone_number' => '081234567893',
                'address' => 'Jl. Slamet Riyadi No. 89, Solo',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000003',
            ],
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000005',
                'salutation' => 'Ibu',
                'gender' => 'female',
                'birth_date' => '1993-07-30',
                'date_of_pregnancy' => '2026-09-20',
                'phone_number' => '081234567894',
                'address' => 'Jl. Diponegoro No. 101, Jogja',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000002',
            ],
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000006',
                'salutation' => 'Mbak',
                'gender' => 'female',
                'birth_date' => '1997-01-18',
                'date_of_pregnancy' => null,
                'phone_number' => '081234567895',
                'address' => 'Jl. Pakuwon No. 22, Surakarta',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000004',
            ],
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000007',
                'salutation' => 'Ibu',
                'gender' => 'female',
                'birth_date' => '1991-04-25',
                'date_of_pregnancy' => '2026-08-30',
                'phone_number' => '081234567896',
                'address' => 'Jl. Kebangkitan No. 55, Jogja',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000005',
            ],
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000008',
                'salutation' => 'Bunda',
                'gender' => 'female',
                'birth_date' => '1994-09-12',
                'date_of_pregnancy' => '2026-12-01',
                'phone_number' => '081234567897',
                'address' => 'Jl. Magelang No. 78, Solo',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000001',
            ],
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000009',
                'salutation' => 'Ibu',
                'gender' => 'female',
                'birth_date' => '1996-06-08',
                'date_of_pregnancy' => '2026-11-25',
                'phone_number' => '081234567898',
                'address' => 'Jl. Prawirotaman No. 33, Jogja',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000003',
            ],
            [
                'account_id' => 'm0000000-0000-0000-0000-000000000010',
                'salutation' => 'Mbak',
                'gender' => 'female',
                'birth_date' => '1992-12-20',
                'date_of_pregnancy' => null,
                'phone_number' => '081234567899',
                'address' => 'Jl. Lawu No. 44, Solo',
                'is_profile_complete' => true,
                'provision_by' => 'a0000000-0000-0000-0000-000000000002',
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
