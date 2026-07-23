<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('photo', 255)->nullable();
            $table->text('content');
            $table->string('role', 100)->nullable()->comment('Contoh: Peserta Seminar Laktasi');
            $table->enum('display_location', ['landing', 'checkout', 'both'])->comment('FR-21: lokasi tampil');
            $table->enum('status', ['published', 'hidden'])->default('hidden')->comment('FR-22: admin toggle tayang');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
