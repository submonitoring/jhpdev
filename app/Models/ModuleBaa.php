<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class ModuleBaa extends Model
{
    public function applicationPaths()
    {
        return $this->hasMany(ApplicationPath::class);
    }

    public function moduleAaa()
    {
        return $this->belongsTo(ModuleAaa::class);
    }

    public function moduleCaas()
    {
        return $this->hasMany(ModuleCaa::class);
    }

    use log;
}
