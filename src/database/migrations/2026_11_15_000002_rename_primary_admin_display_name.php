<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('accounts')
            ->where('email', 'admin@maternity.id')
            ->where('name', 'Admin Utama')
            ->update(['name' => 'Administrator']);

        DB::table('admins')
            ->where('email', 'admin@maternity.id')
            ->where('name', 'Admin Utama')
            ->update(['name' => 'Administrator']);
    }

    public function down(): void
    {
        DB::table('accounts')
            ->where('email', 'admin@maternity.id')
            ->where('name', 'Administrator')
            ->update(['name' => 'Admin Utama']);

        DB::table('admins')
            ->where('email', 'admin@maternity.id')
            ->where('name', 'Administrator')
            ->update(['name' => 'Admin Utama']);
    }
};
