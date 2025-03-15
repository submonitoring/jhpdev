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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->ulid('unique')->nullable();
            $table->string('country_name')->nullable();
            $table->string('alpha_2', 2)
                ->nullable()
                ->unique();
            $table->string('alpha_3', 3)
                ->nullable()
                ->unique();
            $table->string('country_code', 3)
                ->nullable()
                ->unique();
            $table->string('region')->nullable();
            $table->string('sub_region')->nullable();
            $table->string('intermediate_region')->nullable();
            $table->string('region_code')->nullable();
            $table->string('sub_region_code')->nullable();
            $table->string('intermediate_region_code')->nullable();
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
        Schema::dropIfExists('countries');
    }
};
