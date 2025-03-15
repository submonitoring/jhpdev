<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class MaterialMasterPlant extends Model
{
    public function materialMaster()
    {
        return $this->belongsTo(MaterialMaster::class);
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function procurementType()
    {
        return $this->belongsTo(ProcurementType::class);
    }

    public function temperatureCondition()
    {
        return $this->belongsTo(TemperatureCondition::class);
    }

    public function storageCondition()
    {
        return $this->belongsTo(StorageCondition::class);
    }

    use log;
}
