<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class StatusGroup extends Model
{
    public function statusStatusGroups()
    {
        return $this->hasMany(StatusStatusGroup::class);
    }

    public function documentTypes()
    {
        return $this->hasMany(DocumentType::class);
    }

    public function moduleCaas()
    {
        return $this->hasMany(ModuleCaa::class);
    }

    public function statuses()
    {
        return $this->belongsToMany(Status::class);
    }

    public function moduleCaass()
    {
        return $this->morphedByMany(ModuleCaa::class, 'status_groupable');
    }

    public function documentTypess()
    {
        return $this->morphedByMany(DocumentType::class, 'status_groupable');
    }

    use log;
}
