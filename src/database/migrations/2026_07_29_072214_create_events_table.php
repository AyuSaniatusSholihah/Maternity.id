<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('categories');
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->text('description');
            $table->date('event_date');
            $table->date('open_registration_date');
            $table->date('close_registration_date');
            $table->string('location', 255);
            $table->string('image_url', 255)->nullable();
            $table->uuid('materials')->nullable();
            $table->unsignedInteger('slot');
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
