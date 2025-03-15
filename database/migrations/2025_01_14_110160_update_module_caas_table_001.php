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
        Schema::table('module_caas', function (Blueprint $table) {
            $table->foreignId('status_group_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }
};
