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
        Schema::create('transcations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('ordered_at');
            $table->char('attendance_code', 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
