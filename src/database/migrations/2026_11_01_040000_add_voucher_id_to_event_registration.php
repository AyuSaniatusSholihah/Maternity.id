<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('event_registration', function (Blueprint $table) {
            $table->uuid('voucher_id')->nullable();
            $table->foreign('voucher_id')->references('id')->on('vouchers');
        });
    }

    public function down(): void
    {
        Schema::table('event_registration', function (Blueprint $table) {
            $table->dropForeign(['voucher_id']);
            $table->dropColumn('voucher_id');
        });
    }
};
