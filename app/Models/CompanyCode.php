<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class CompanyCode extends Model
{
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }

    public function purchasingOrganizations()
    {
        return $this->hasMany(PurchasingOrganization::class);
    }

    public function chartOfAccount()
    {
        return $this->belongsTo(ChartOfAccount::class);
    }

    public function salesOrganizations()
    {
        return $this->hasMany(SalesOrganization::class);
    }

    public function businessPartnerCompanies()
    {
        return $this->hasMany(BusinessPartnerCompany::class);
    }

    use log;
}
