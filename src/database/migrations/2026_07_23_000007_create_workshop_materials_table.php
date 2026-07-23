<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel pivot many-to-many workshop <-> material (FR-07, FR-15)
        Schema::create('workshop_materials', function (Blueprint $table) {
            $table->uuid('workshop_id');
            $table->uuid('material_id');

            $table->primary(['workshop_id', 'material_id']);
            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshop_materials');
    }
};
