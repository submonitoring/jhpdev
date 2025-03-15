<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class SalesOffice extends Model
{
    public function salesAreaSalesOffices()
    {
        return $this->hasMany(SalesAreaSalesOffice::class);
    }

    public function salesGroupSalesOffices()
    {
        return $this->hasMany(SalesGroupSalesOffice::class);
    }

    public function salesAreas()
    {
        return $this->belongsToMany(SalesArea::class);
    }

    use log;
}
