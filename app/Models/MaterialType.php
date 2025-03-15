<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;

class MaterialType extends Model
{

    // use HasFilamentComments;

    public function numberRange()
    {
        return $this->belongsTo(NumberRange::class);
    }

    public function materialMasters()
    {
        return $this->hasMany(MaterialMaster::class);
    }

    use log;
}
