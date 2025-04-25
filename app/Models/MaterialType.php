<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;

class MaterialType extends Model
{

    // use HasFilamentComments;

    public function numberRange()
    {
        return $this->belongsTo(NumberRange::class);
    }

    public function materialMasters()
    {
        return $this->hasMany(MaterialMaster::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->material_type_desc;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->material_type_desc;
        });
    }

    use log;
}
