<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    private const CATEGORIES = [
        'Pertumbuhan Remaja',
        'Pranikah & Prakonsepsi',
        'Kehamilan',
    ];

    public function up(): void
    {
        foreach (self::CATEGORIES as $name) {
            DB::table('categories')->insertOrIgnore([
                'id' => (string) Str::uuid(),
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Kategori: ' . $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('categories')->whereIn('name', self::CATEGORIES)->delete();
    }
};
