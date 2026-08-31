<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 255);
            $table->string('slug', 260)->unique();
            $table->text('description');
            $table->string('thumbnail_image', 255)->nullable();
            $table->string('content_link', 255);
            $table->unsignedInteger('viewer_count')->default(0);
            $table->timestamps();

            $table->foreignUuid('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreignUuid('uploaded_by')->references('account_id')->on('admins')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
