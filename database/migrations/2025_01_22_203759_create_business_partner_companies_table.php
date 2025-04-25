<?php

use App\Models\AccountAssignmentGroup;
use App\Models\Currency;
use App\Models\PaymentTerm;
use App\Models\TaxClassification;
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
        Schema::create('business_partner_companies', function (Blueprint $table) {
            $table->id();
            $table->ulid('unique')->nullable();
            $table->string('record_title')->nullable();
            $table->string('sort')->nullable();
            $table->foreignId('business_partner_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('company_code_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->unsignedBigInteger('cust_account_assignment_group_id')->nullable();
            $table->foreign('cust_account_assignment_group_id', 'cust_aag_id_foreign')
                ->references('id')
                ->on('account_assignment_groups')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(TaxClassification::class, 'cust_tax_classification_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Currency::class, 'cust_currency_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PaymentTerm::class, 'cust_payment_term_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->unsignedBigInteger('vend_account_assignment_group_id')->nullable();
            $table->foreign('vend_account_assignment_group_id', 'vend_aag_id_foreign')
                ->references('id')
                ->on('account_assignment_groups')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(TaxClassification::class, 'vend_tax_classification_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Currency::class, 'vend_currency_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PaymentTerm::class, 'vend_payment_term_id')
                ->nullable()
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
        Schema::dropIfExists('business_partner_companies');
    }
};
