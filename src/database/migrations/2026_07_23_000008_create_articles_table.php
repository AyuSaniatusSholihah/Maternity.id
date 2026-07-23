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
            $table->string('slug', 260)->unique();
            $table->longText('content');
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_description', 160)->nullable()->comment('Max 160 karakter sesuai best practice SEO');
            $table->string('thumbnail_image', 255)->nullable();
            $table->uuid('related_workshop_id')->nullable()->comment('Workshop yang dipromosikan di akhir artikel');
            $table->uuid('author_id')->comment('Admin penulis');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->dateTime('published_at')->nullable();
            $table->timestamps();

            $table->foreign('related_workshop_id')->references('id')->on('workshops')->onDelete('set null');
            $table->foreign('author_id')->references('account_id')->on('admins')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
