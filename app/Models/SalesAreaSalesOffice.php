<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class SalesAreaSalesOffice extends Model
{
    protected $table = 'sales_area_sales_office';

    public function salesArea()
    {
        return $this->belongsTo(SalesArea::class);
    }

    public function salesOffice()
    {
        return $this->belongsTo(SalesOffice::class);
    }

    use log;
}
