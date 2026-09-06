<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders in dependency order
        // AdminSeeder needs member accounts to exist first (selects random member to make admin)
        $this->call([
            AccountSeeder::class,
            MemberSeeder::class,
            AdminSeeder::class,
            MaterialSeeder::class,
            EventSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
