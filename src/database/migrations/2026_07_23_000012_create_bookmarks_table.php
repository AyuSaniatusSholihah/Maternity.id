<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Polymorphic bookmark — bisa untuk workshop atau material (FR-12)
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('member_id');
            $table->uuid('bookmarkable_id')->comment('ID target: workshop.id atau material.id');
            $table->string('bookmarkable_type', 50)->comment('workshop atau material');
            $table->timestamps();

            // Cegah duplikat bookmark
            $table->unique(['member_id', 'bookmarkable_id', 'bookmarkable_type']);
            $table->foreign('member_id')->references('account_id')->on('members')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};
