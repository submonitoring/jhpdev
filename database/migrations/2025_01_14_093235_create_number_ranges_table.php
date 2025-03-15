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
        Schema::create('number_ranges', function (Blueprint $table) {
            $table->id();
            $table->ulid('unique')->nullable();
            $table->foreignId('nr_object_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('number_range_interval')->nullable();
            $table->string('number_range_name')->nullable();
            $table->string('year')->nullable();
            $table->string('number')->nullable();
            $table->string('current_number')->nullable();
            $table->boolean('is_external')->nullable();
            $table->string('con')->nullable();
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
        Schema::dropIfExists('number_ranges');
    }
};
