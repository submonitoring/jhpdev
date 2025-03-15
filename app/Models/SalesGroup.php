<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class SalesGroup extends Model
{
    public function salesGroupSalesOffices()
    {
        return $this->hasMany(SalesGroupSalesOffice::class);
    }

    use log;
}
