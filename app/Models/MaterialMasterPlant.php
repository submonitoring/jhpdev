<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->materialMaster->material_number;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->materialMaster->material_number;
        });
    }

    use log;
}
