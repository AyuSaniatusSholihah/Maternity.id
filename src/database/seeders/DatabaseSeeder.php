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
        $this->call([
            AccountSeeder::class,                  // Base accounts (no dependencies)
            AdminSeeder::class,                    // Depends on accounts
            MemberSeeder::class,                   // Depends on accounts and admins
            CategorySeeder::class,                 // Categories (no dependencies)
            MaterialSeeder::class,                 // Depends on categories and admins
            EventSeeder::class,                    // Depends on admins, categories, and materials (for pivot table)
            ProductSeeder::class,                  // Depends on admins and categories
            EventRegistrationSeeder::class,        // Depends on events, members, admins
            SubscriptionPlansSeeder::class,        // Depends on admins
            SubscriptionPaymentsSeeder::class,     // Depends on members and subscription_plans
            ArticleSeeder::class,                  // Depends on admins and categories
        ]);
    }
}
