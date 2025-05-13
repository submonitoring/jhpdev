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
        Schema::create('account_determination_items', function (Blueprint $table) {
            $table->id();

            $table->string('sort')->nullable();
            $table->foreignId('account_determination_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('debit_credit_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('gl_account_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->ulid('unique')->nullable();
            $table->string('record_title')->nullable();

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
        Schema::dropIfExists('account_determination_items');
    }
};
