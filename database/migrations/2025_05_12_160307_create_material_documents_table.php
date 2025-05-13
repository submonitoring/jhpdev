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
        Schema::create('material_documents', function (Blueprint $table) {
            $table->id();

            $table->date('document_date')->nullable();
            $table->foreignId('transaction_type_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('transaction_reference_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('business_partner_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('document_type_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('number_range_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('document_number')->nullable();
            $table->text('text_header')->nullable();

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
        Schema::dropIfExists('material_documents');
    }
};
