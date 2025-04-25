<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ApplicationPath extends Model
{
    public function applicationName()
    {
        return $this->belongsTo(ApplicationName::class);
    }

    public function moduleAaa()
    {
        return $this->belongsTo(ModuleAaa::class);
    }

    public function moduleBaa()
    {
        return $this->belongsTo(ModuleBaa::class);
    }

    public function moduleCaa()
    {
        return $this->belongsTo(ModuleCaa::class);
    }

    public function moduleActivityType()
    {
        return $this->belongsTo(ModuleActivityType::class);
    }

    public function moduleActivity()
    {
        return $this->belongsTo(ModuleActivity::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'canviewany_id');
    }

    public function users2()
    {
        return $this->hasMany(User::class, 'cancreate_id');
    }

    public function users3()
    {
        return $this->hasMany(User::class, 'canupdate_id');
    }

    public function users4()
    {
        return $this->hasMany(User::class, 'canview_id');
    }

    public function users5()
    {
        return $this->hasMany(User::class, 'candelete_id');
    }

    public function users6()
    {
        return $this->hasMany(User::class, 'canforcedelete_id');
    }

    public function users7()
    {
        return $this->hasMany(User::class, 'canforcedeleteany_id');
    }

    public function users8()
    {
        return $this->hasMany(User::class, 'canrestore_id');
    }

    public function users9()
    {
        return $this->hasMany(User::class, 'canrestoreany_id');
    }

    public function users10()
    {
        return $this->hasMany(User::class, 'canreorder_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->module_caa_id;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->module_caa_id;
        });
    }

    use log;
}
