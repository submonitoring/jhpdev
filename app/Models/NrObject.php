<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class NrObject extends Model
{
    public function numberRanges()
    {
        return $this->hasMany(NumberRange::class);
    }

    use log;
}
