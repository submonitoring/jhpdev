<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class BpRole extends Model
{
    public function businessPartners()
    {
        return $this->hasMany(BusinessPartner::class);
    }

    use log;
}
