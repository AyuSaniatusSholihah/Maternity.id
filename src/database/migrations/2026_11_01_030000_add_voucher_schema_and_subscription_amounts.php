<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('maximum_discount')->nullable();
            $table->decimal('discount', 5, 2);
            $table->boolean('is_usable')->default(true);
            $table->dateTime('valid_from');
            $table->dateTime('valid_until')->nullable();
            $table->smallInteger('max_redem');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->uuid('created_by');
        });

        Schema::create('associated_voucher', function (Blueprint $table) {
            $table->uuid('voucher_id');
            $table->uuid('item_id');
            $table->string('item_type');

            $table->primary(['voucher_id', 'item_id', 'item_type']);
            $table->foreign('voucher_id')->references('id')->on('vouchers');
        });

        Schema::table('subscription_payments', function (Blueprint $table) {
            $table->integer('subamount')->nullable();
            $table->uuid('voucher_id')->nullable();
            $table->integer('total_amount')->nullable();

            $table->foreign('voucher_id')->references('id')->on('vouchers');
        });

        DB::table('subscription_payments')->update([
            'subamount' => 0,
            'total_amount' => 0,
        ]);

        Schema::table('subscription_payments', function (Blueprint $table) {
            $table->integer('subamount')->nullable(false)->change();
            $table->integer('total_amount')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('subscription_payments', function (Blueprint $table) {
            $table->dropForeign(['voucher_id']);
            $table->dropColumn(['subamount', 'voucher_id', 'total_amount']);
        });

        Schema::dropIfExists('associated_voucher');
        Schema::dropIfExists('vouchers');
    }
};
