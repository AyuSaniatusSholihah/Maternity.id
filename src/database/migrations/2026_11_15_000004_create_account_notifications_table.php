<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_notifications', function (Blueprint $table): void {
            $table->id();
            $table->uuid('account_id');
            $table->string('type', 50);
            $table->string('title', 255);
            $table->text('message');
            $table->string('url', 500)->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->index(['account_id', 'read_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_notifications');
    }
};
