<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class SalesArea extends Model
{
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

    public function salesAreaSalesOffices()
    {
        return $this->hasMany(SalesAreaSalesOffice::class);
    }

    public function salesOffices()
    {
        return $this->belongsToMany(SalesOffice::class);
    }

    use log;
}
