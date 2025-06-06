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
        Schema::create('material_master_plants', function (Blueprint $table) {
            $table->id();
            $table->string('sort')->nullable();
            $table->ulid('unique')->nullable();
            $table->string('record_title')->nullable();
            $table->foreignId('material_master_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('plant_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('safety_stock')->nullable();
            $table->string('minimal_safety_stock')->nullable();
            $table->string('con')->nullable();
            $table->boolean('is_external_batch')->nullable();
            $table->boolean('is_internal_batch')->nullable();
            $table->foreignId('procurement_type_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('temperature_condition_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('storage_condition_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->boolean('is_active')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_master_plants');
    }
};
