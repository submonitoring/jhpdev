<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class BusinessPartner extends Model
{

    protected $casts = [
        'bp_role_id' => 'array',
    ];

    public function numberRange()
    {
        return $this->belongsTo(NumberRange::class);
    }

    public function bpCategory()
    {
        return $this->belongsTo(BpCategory::class);
    }

    public function bpRole()
    {
        return $this->belongsTo(BpRole::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function kodepos()
    {
        return $this->belongsTo(Kodepos::class);
    }

    public function businessPartnerCustomers()
    {
        return $this->hasMany(BusinessPartnerCustomer::class);
    }

    public function businessPartnerVendors()
    {
        return $this->hasMany(BusinessPartnerVendor::class);
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

    public function businessPartnerCompanies()
    {
        return $this->hasMany(BusinessPartnerCompany::class);
    }

    public function batchMasters()
    {
        return $this->hasMany(BatchMaster::class);
    }

    use log;
}
