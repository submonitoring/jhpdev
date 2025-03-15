<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

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

    use log;
}
