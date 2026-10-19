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
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('provisioned_by')->references('account_id')->on('admins')->onDelete('restrict');
        });
        
        Schema::table('materials', function (Blueprint $table) {
            $table->foreign('categories')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('uploaded_by')->references('account_id')->on('admins')->onDelete('restrict');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('categories')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('author')->references('account_id')->on('admins')->onDelete('restrict');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('categories')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('materials')->references('id')->on('materials')->onDelete('restrict');
            $table->foreign('created_by')->references('account_id')->on('admins')->onDelete('restrict');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('categories')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('created_by')->references('account_id')->on('admins')->onDelete('restrict');
        });

        Schema::create('event_registration', function (Blueprint $table) {
            $table->uuid('event_id');
            $table->uuid('user_id');
            $table->uuid('reviewer_id')->nullable();
            $table->text('payment_status');
            $table->string('proof_img_url', 500)->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->string('message', 255)->nullable();
            $table->timestamps();

            $table->primary(['event_id', 'user_id']);
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('account_id')->on('admins')->onDelete('set null');
        });

        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->char('code', 8)->primary();
            $table->string('name', 50)->nullable();
            $table->text('benefits');
            $table->unsignedInteger('price');
            $table->unsignedInteger('period');
            $table->uuid('updated_by');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->softDeletes();

            $table->foreign('updated_by')->references('account_id')->on('admins')->onDelete('restrict');
        });

        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->char('subcription_code', 8);
            $table->uuid('user_id');
            $table->uuid('reviewer_id')->nullable();
            $table->text('payment_status');
            $table->string('proof_img_url', 500)->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->string('message', 255)->nullable();
            $table->timestamp('started_at');
            $table->timestamp('ended_at');
            $table->timestamps();

            $table->primary(['subcription_code', 'user_id']);
            $table->foreign('subcription_code')->references('code')->on('subscription_plans')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('account_id')->on('admins')->onDelete('set null');
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
