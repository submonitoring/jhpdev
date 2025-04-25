<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Uom extends Model
{
    public function materialMasters()
    {
        return $this->hasMany(MaterialMaster::class, 'base_uom_id');
    }

    public function materialMasters2()
    {
        return $this->hasMany(MaterialMaster::class, 'weight_unit_id');
    }

    public function bomHeaders()
    {
        return $this->hasMany(BomHeader::class);
    }

    public function bomItems()
    {
        return $this->hasMany(BomItem::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->uom_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->uom_name;
        });
    }

    use log;
}
