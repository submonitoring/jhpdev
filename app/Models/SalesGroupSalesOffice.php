<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class SalesGroupSalesOffice extends Model
{
    protected $table = 'sales_group_sales_office';

    public function salesGroup()
    {
        return $this->belongsTo(SalesGroup::class);
    }

    public function salesOffice()
    {
        return $this->belongsTo(SalesOffice::class);
    }

    use log;
}
