<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class ApplicationName extends Model
{

    public function applicationPaths()
    {
        return $this->hasMany(ApplicationPath::class);
    }

    public function moduleAaas()
    {
        return $this->hasMany(ModuleAaa::class);
    }

    use log;
}
