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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('categories');
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('thumbnail_img', 255)->nullable();
            $table->unsignedInteger('click_count')->nullable();
            $table->string('tiktok_url', 255)->nullable();
            $table->string('tokopedia_url', 255)->nullable();
            $table->string('shopee_url', 255)->nullable();
            $table->string('whatsapp_url', 255)->nullable();
            $table->uuid('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
