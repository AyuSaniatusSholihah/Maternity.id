<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('member_id');
            $table->date('active_from');
            $table->date('active_until');
            $table->decimal('amount_paid', 10, 2);
            $table->uuid('provision_by')->comment('Admin yang mengaktifkan langganan ini (FR-09)');
            $table->dateTime('booked_at')->useCurrent();
            $table->timestamps();

            $table->foreign('member_id')->references('account_id')->on('members')->onDelete('cascade');
            $table->foreign('provision_by')->references('account_id')->on('admins')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
