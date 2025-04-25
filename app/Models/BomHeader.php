<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BomHeader extends Model
{
    public function numberRange()
    {
        return $this->belongsTo(NumberRange::class);
    }

    public function materialMaster()
    {
        return $this->belongsTo(MaterialMaster::class);
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class);
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
            $model->record_title = $model->bom_number;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->bom_number;
        });
    }

    use log;
}
