<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class IndustrySector extends Model
{

    public function materialMasters()
    {
        return $this->hasMany(MaterialMaster::class);
    }

    use log;
}
