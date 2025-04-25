<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BusinessPartnerCustomer extends Model
{
    public function businessPartner()
    {
        return $this->belongsTo(BusinessPartner::class);
    }

    public function salesOrganization()
    {
        return $this->belongsTo(SalesOrganization::class);
    }

    public function distributionChannel()
    {
        return $this->belongsTo(DistributionChannel::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
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
