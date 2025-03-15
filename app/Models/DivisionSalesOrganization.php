<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class DivisionSalesOrganization extends Model
{
    protected $table = 'division_sales_organization';

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function salesOrganization()
    {
        return $this->belongsTo(SalesOrganization::class);
    }

    use log;
}
