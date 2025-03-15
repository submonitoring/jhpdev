<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function companyCodes()
    {
        return $this->hasMany(CompanyCode::class);
    }

    public function salesOrganizations()
    {
        return $this->hasMany(SalesOrganization::class);
    }

    public function businessPartnerCustomers()
    {
        return $this->hasMany(BusinessPartnerCustomer::class);
    }

    public function businessPartnerVendors()
    {
        return $this->hasMany(BusinessPartnerVendor::class);
    }

    public function businessPartners()
    {
        return $this->hasMany(BusinessPartner::class);
    }

    public function businessPartnerCompanies()
    {
        return $this->hasMany(BusinessPartnerCompany::class, 'cust_currency_id');
    }

    public function businessPartnerCompanies2()
    {
        return $this->hasMany(BusinessPartnerCompany::class, 'vend_currency_id');
    }

    use log;
}
