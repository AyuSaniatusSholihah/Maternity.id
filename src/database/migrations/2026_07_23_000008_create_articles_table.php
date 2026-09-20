<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255);
            $table->string('keywords', 255)->nullable();
            $table->string('slug', 260)->unique();
            $table->text('short_description')->nullable();
            $table->string('thumbnail_image', 255)->nullable();
            $table->longText('content');
            $table->unsignedBigInteger('views_count')->default(0);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
