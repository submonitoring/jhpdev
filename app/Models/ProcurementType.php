<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class ProcurementType extends Model
{

    public function materialMasterPlants()
    {
        return $this->hasMany(MaterialMasterPlant::class);
    }

    use log;
}
