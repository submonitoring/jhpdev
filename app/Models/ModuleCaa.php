<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->module_caa_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->module_caa_name;
        });
    }

    use log;
}
