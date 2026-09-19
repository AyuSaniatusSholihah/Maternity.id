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
        $provisioner = Admin::where('position', 'consultant')->first();

        foreach ($memberEmails as $index => $email) {
            $account = Account::where('email', $email)->first();

            if ($account) {
                Member::create([
                    'account_id' => $account->id,
                    'gender' => 'female',
                    'phone_number' => 6281200000000 + $index,
                    'salutation' => 'Ibu',
                    'birth_date' => now()->subYears(25 + $index)->toDateString(),
                    'job' => match($index) {
                        0 => 'Karyawan Swasta',
                        1 => 'Guru',
                        2 => 'Konsultan',
                        3 => 'Wiraswasta',
                        4 => 'Ibu Rumah Tangga',
                        default => 'Profesi Lainnya',
                    },
                    'address' => match($index) {
                        0 => 'Jl. Merdeka No. 123, Jakarta',
                        1 => 'Jl. Sudirman No. 45, Bandung',
                        2 => 'Jl. Gatot Subroto No. 67, Surabaya',
                        3 => 'Jl. Ahmad Yani No. 89, Medan',
                        4 => 'Jl. Diponegoro No. 101, Yogyakarta',
                        default => 'Alamat Tidak Tersedia',
                    },
                    'zip_code' => 12000 + $index * 1000,
                    'institution' => match($index) {
                        0 => 'RSIA Bunda Jakarta',
                        1 => 'RSIA Citra Bandung',
                        2 => 'RSIA Mitra Surabaya',
                        3 => 'RSIA Murni Medan',
                        4 => 'RSIA Cakti Yogyakarta',
                        default => null,
                    },
                    'provision_by' => $provisioner?->account_id,
                ]);
            }
        }
    }
}
