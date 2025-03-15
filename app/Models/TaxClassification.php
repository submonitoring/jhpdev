<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class TaxClassification extends Model
{
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
        return $this->hasMany(
            BusinessPartnerCompany::class,
            'cust_tax_classification_id'
        );
    }

    public function businessPartnerCompanies2()
    {
        return $this->hasMany(
            BusinessPartnerCompany::class,
            'vend_tax_classification_id'
        );
    }

    public function allMaterialMasterSales()
    {
        return $this->hasMany(MaterialMasterSales::class);
    }

    use log;
}
