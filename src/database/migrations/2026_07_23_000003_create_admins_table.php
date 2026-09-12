<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->date('assigned_at');
            $table->enum('position', ['maintainer', 'consultant']);
            $table->string('number_contact', 15);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
