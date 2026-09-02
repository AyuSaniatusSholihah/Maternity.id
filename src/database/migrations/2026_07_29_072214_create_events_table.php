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
            $table->string('name', 255);
            $table->string('slug', 260)->unique();
            $table->string('mentor_name', 255)->nullable();
            $table->text('description');
            $table->string('poster_img', 255)->nullable();
            $table->date('date');
            $table->string('location', 355);
            $table->enum('venue', ['online', 'offline']);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('is_available')->default(true);
            $table->decimal('price', 10, 2)->default(0);
            $table->text('gc_invitation_link');
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
