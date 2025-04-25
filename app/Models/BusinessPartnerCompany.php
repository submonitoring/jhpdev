<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BusinessPartnerCompany extends Model
{
    public function businessPartner()
    {
        return $this->belongsTo(BusinessPartner::class);
    }

    public function companyCode()
    {
        return $this->belongsTo(CompanyCode::class);
    }

    public function custaccountAssignmentGroup()
    {
        return $this->belongsTo(AccountAssignmentGroup::class, 'cust_account_assignment_group_id');
    }

    public function custtaxClassification()
    {
        return $this->belongsTo(TaxClassification::class, 'cust_tax_classification_id');
    }

    public function custcurrency()
    {
        return $this->belongsTo(Currency::class, 'cust_currency_id');
    }

    public function custpaymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class, 'cust_payment_term_id');
    }

    public function vendaccountAssignmentGroup()
    {
        return $this->belongsTo(AccountAssignmentGroup::class, 'vend_account_assignment_group_id');
    }

    public function vendtaxClassification()
    {
        return $this->belongsTo(TaxClassification::class, 'vend_tax_classification_id');
    }

    public function vendcurrency()
    {
        return $this->belongsTo(Currency::class, 'vend_currency_id');
    }

    public function vendpaymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class, 'vend_payment_term_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->businessPartner->bp_number;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->businessPartner->bp_number;
        });
    }

    use log;
}
