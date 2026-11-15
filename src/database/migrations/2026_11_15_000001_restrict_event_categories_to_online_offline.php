<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table): void {
            $table->dropForeign(['categories']);
        });

        DB::table('events')->update([
            'categories' => DB::raw("CASE WHEN lower(location) LIKE '%online%' OR lower(location) LIKE '%zoom%' THEN 'online' ELSE 'offline' END"),
        ]);

        Schema::table('events', function (Blueprint $table): void {
            $table->enum('categories', ['online', 'offline'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table): void {
            $table->uuid('categories')->change();
            $table->foreign('categories')->references('id')->on('categories')->onDelete('restrict');
        });
    }
};
