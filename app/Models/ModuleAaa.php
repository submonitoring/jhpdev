<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class ModuleAaa extends Model
{
    public function applicationPaths()
    {
        return $this->hasMany(ApplicationPath::class);
    }

    public function applicationName()
    {
        return $this->belongsTo(ApplicationName::class);
    }

    public function moduleBaas()
    {
        return $this->hasMany(ModuleBaa::class);
    }

    use log;
}
