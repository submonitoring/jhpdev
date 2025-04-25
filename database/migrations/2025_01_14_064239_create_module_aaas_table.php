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
        Schema::create('module_aaas', function (Blueprint $table) {
            $table->id();
            $table->ulid('unique')->nullable();
            $table->string('record_title')->nullable();
            $table->string('module_aaa')->nullable();
            $table->string('module_aaa_name')->nullable();
            $table->foreignId('application_name_id')->nullable()
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
        Schema::dropIfExists('module_aaas');
    }
};
