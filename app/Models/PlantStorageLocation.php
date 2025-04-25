<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PlantStorageLocation extends Model
{

    protected $table = 'plant_storage_location';

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function storageLocation()
    {
        return $this->belongsTo(StorageLocation::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->plant->plant_name . ' ' . $model->storageLocation->storage_location_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->plant->plant_name . ' ' . $model->storageLocation->storage_location_name;
        });
    }

    use log;
}
