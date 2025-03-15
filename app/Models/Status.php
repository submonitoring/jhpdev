<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function statusStatusGroups()
    {
        return $this->hasMany(StatusStatusGroup::class);
    }

    public function statusGroups()
    {
        return $this->belongsToMany(StatusGroup::class);
    }

    use log;
}
