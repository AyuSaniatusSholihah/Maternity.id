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
            $table->enum('salutation', ['Ibu', 'Bunda', 'Mbak', 'Suster', 'Dokter']);
            $table->enum('gender', ['female', 'male']);
            $table->date('birth_date');
            $table->date('date_of_pregnancy')->nullable()->comment('HPL - hari perkiraan lahir');
            $table->uuid('provision_by')->comment('Admin yang mendaftarkan member ini');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('provision_by')->references('account_id')->on('admins')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
