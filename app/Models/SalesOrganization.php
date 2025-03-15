<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class SalesOrganization extends Model
{
    public function companyCode()
    {
        return $this->belongsTo(CompanyCode::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function distributionChannelSalesOrganizations()
    {
        return $this->hasMany(DistributionChannelSalesOrganization::class);
    }

    public function divisionSalesOrganizations()
    {
        return $this->hasMany(DivisionSalesOrganization::class);
    }

    public function salesAreas()
    {
        return $this->hasMany(SalesArea::class);
    }

    public function businessPartnerCustomers()
    {
        return $this->hasMany(BusinessPartnerCustomer::class);
    }

    public function allMaterialMasterSales()
    {
        return $this->hasMany(MaterialMasterSales::class);
    }

    public function distributionChannels()
    {
        return $this->belongsToMany(DistributionChannel::class);
    }

    public function divisions()
    {
        return $this->belongsToMany(Division::class);
    }

    use log;
}
