<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->application_name_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->application_name_name;
        });
    }

    use log;
}
