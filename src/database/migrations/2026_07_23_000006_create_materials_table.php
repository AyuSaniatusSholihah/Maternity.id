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
            $table->string('name', 255);
            $table->string('slug', 260)->unique();
            $table->text('description')->nullable();
            $table->string('thumbnail_image', 255)->nullable();
            $table->text('content_link')->comment('URL ke file: Google Drive, dsb.');
            $table->unsignedInteger('viewer_count')->default(0);
            $table->uuid('uploaded_by')->comment('Admin yang mengupload materi (FR-15)');
            $table->timestamps();

            $table->foreign('uploaded_by')->references('account_id')->on('admins')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
