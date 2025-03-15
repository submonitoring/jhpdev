<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class StorageLocation extends Model
{

    public function plants()
    {
        return $this->belongsToMany(Plant::class);
    }

    use log;
}
