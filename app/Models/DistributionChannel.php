<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class DistributionChannel extends Model
{
    public function distributionChannelSalesOrganizations()
    {
        return $this->hasMany(DistributionChannelSalesOrganization::class);
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

    public function salesOrganizations()
    {
        return $this->belongsToMany(SalesOrganization::class);
    }

    use log;
}
