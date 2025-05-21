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
        Schema::table('material_master_plants', function (Blueprint $table) {
            $table->string('material_desc')->nullable();
            $table->string('plant_name')->nullable();
        });
    }
};
