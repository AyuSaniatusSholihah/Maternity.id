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
        Schema::table('admins', function (Blueprint $table) {
            $table->foreignUuid('account_id')->primary()->references('id')->on('accounts')->onDelete('cascade');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->foreignUuid('account_id')->primary()->references('id')->on('accounts')->onDelete('cascade');
            $table->foreignUuid('provision_by')->nullable()->references('account_id')->on('admins')->onDelete('restrict');
        });
        
        Schema::table('materials', function (Blueprint $table) {
            $table->foreignUuid('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreignUuid('uploaded_by')->references('account_id')->on('admins')->onDelete('restrict');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreignUuid('author_id')->references('account_id')->on('admins')->onDelete('restrict');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreignUuid('created_by')->references('account_id')->on('admins')->onDelete('restrict');
        });

        Schema::table('transcations', function (Blueprint $table) {
            $table->foreignUuid('account_id')->references('account_id')->on('members')->onDelete('cascade');
            $table->foreignUuid('verified_by')->references('account_id')->on('admins')->onDelete('cascade');
            $table->foreignUuid('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
