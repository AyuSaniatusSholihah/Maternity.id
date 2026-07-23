<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->string('slug', 260)->unique();
            $table->text('description');
            $table->string('topic', 100)->comment('Filter FR-04: topik seminar');
            $table->enum('format', ['online', 'offline', 'hybrid'])->comment('Filter FR-04: format');
            $table->date('date');
            $table->decimal('price', 10, 2)->default(0)->comment('Filter FR-04: harga');
            $table->text('location_string')->nullable()->comment('Nullable karena seminar online tidak perlu lokasi');
            $table->text('location_maps')->nullable();
            $table->string('thumbnail_image', 255)->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'done', 'cancelled'])->default('upcoming');
            $table->uuid('created_by')->comment('Admin yang mengupload seminar');
            $table->timestamps();

            $table->foreign('created_by')->references('account_id')->on('admins')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
