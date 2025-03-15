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
        Schema::create('business_partners', function (Blueprint $table) {
            $table->id();
            $table->ulid('unique')->nullable();
            $table->foreignId('number_range_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('bp_number')->nullable();
            $table->foreignId('bp_category_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->json('bp_role_id')->nullable();
            $table->foreignId('account_assignment_group_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('tax_classification_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('currency_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('payment_term_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('vat_number')->nullable();
            $table->foreignId('title_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('name_1')->nullable();
            $table->string('name_2')->nullable();
            $table->string('name_3')->nullable();
            $table->string('name_4')->nullable();
            $table->string('search_term')->nullable();
            $table->string('search_term2')->nullable();
            $table->string('telephone_number_1')->nullable();
            $table->string('telephone_number_1_ext')->nullable();
            $table->string('telephone_number_2')->nullable();
            $table->string('telephone_number_2_ext')->nullable();
            $table->string('fax_number_1')->nullable();
            $table->string('fax_number_1_ext')->nullable();
            $table->string('fax_number_2')->nullable();
            $table->string('fax_number_2_ext')->nullable();
            $table->string('handphone_number_1')->nullable();
            $table->string('handphone_number_2')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('country_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('provinsi_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('kabupaten_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('kecamatan_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('kelurahan_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('kodepos_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('kodepos')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('region')->nullable();
            $table->string('po_box')->nullable();
            $table->text('street')->nullable();
            $table->string('building_number')->nullable();
            $table->string('floor')->nullable();
            $table->string('room')->nullable();
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
        Schema::dropIfExists('business_partners');
    }
};
