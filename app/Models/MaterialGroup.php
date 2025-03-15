<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class MaterialGroup extends Model
{

    public function materialMasters()
    {
        return $this->hasMany(MaterialMaster::class);
    }

    public function allMaterialMasterSales()
    {
        return $this->hasMany(MaterialMasterSales::class);
    }

    use log;
}
