<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class BusinessPartnerVendor extends Model
{
    public function businessPartner()
    {
        return $this->belongsTo(BusinessPartner::class);
    }

    public function purchasingOrganization()
    {
        return $this->belongsTo(PurchasingOrganization::class);
    }

    public function accountAssignmentGroup()
    {
        return $this->belongsTo(AccountAssignmentGroup::class);
    }

    public function taxClassification()
    {
        return $this->belongsTo(TaxClassification::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class);
    }

    use log;
}
