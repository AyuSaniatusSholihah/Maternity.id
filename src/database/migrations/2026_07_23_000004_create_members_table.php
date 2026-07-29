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
            $table->enum('gender', ['female', 'male']);
            $table->bigInteger('phone_number')->unique();
            $table->enum('salutation', ['Bapak', 'Ayah', 'Mas', 'Ibu', 'Bunda', 'Mbak', 'Suster', 'Dokter']);
            $table->date('birth_date');
            $table->string('job')->nullable();
            $table->string('address');
            $table->integer('zip_code');
            $table->string('institution')->nullable();
            $table->uuid('provision_by')->nullable();

            $table->foreignUuid('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreignUuid('provision_by')->references('account_id')->on('admins')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
