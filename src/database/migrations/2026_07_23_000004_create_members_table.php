<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('account_id')->primary();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('phone', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->char('gender', 1)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('image_url', 255)->nullable();
            $table->uuid('provisioned_by')->nullable();
            $table->nullableTimestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
