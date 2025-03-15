<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class ModuleActivity extends Model
{
    public function applicationPaths()
    {
        return $this->hasMany(ApplicationPath::class);
    }

    use log;
}
