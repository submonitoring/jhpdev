<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    public function companyCode()
    {
        return $this->belongsTo(CompanyCode::class);
    }

    public function materialMasterPlants()
    {
        return $this->hasMany(MaterialMasterPlant::class);
    }

    public function allMaterialMasterSales()
    {
        return $this->hasMany(MaterialMasterSales::class);
    }

    public function storageLocations()
    {
        return $this->belongsToMany(StorageLocation::class);
    }

    use log;
}
