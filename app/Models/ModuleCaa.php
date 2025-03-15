<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class ModuleCaa extends Model
{
    public function applicationPaths()
    {
        return $this->hasMany(ApplicationPath::class);
    }

    public function moduleBaa()
    {
        return $this->belongsTo(ModuleBaa::class);
    }

    public function moduleActivityType()
    {
        return $this->belongsTo(ModuleActivityType::class);
    }

    public function documentTypes()
    {
        return $this->hasMany(DocumentType::class);
    }

    public function statusGroup()
    {
        return $this->belongsTo(StatusGroup::class);
    }

    public function statusGroups()
    {
        return $this->morphToMany(StatusGroup::class, 'status_groupable');
    }

    use log;
}
