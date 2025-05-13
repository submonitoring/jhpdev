<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function materialDocumentItems()
    {
        return $this->hasMany(MaterialDocumentItem::class);
    }

    public function storageLocations()
    {
        return $this->belongsToMany(StorageLocation::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->plant_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->plant_name;
        });
    }

    use log;
}
