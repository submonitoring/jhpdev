<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class PurchasingOrganization extends Model
{
    public function companyCode()
    {
        return $this->belongsTo(CompanyCode::class);
    }

    public function businessPartnerVendors()
    {
        return $this->hasMany(BusinessPartnerVendor::class);
    }

    use log;
}
