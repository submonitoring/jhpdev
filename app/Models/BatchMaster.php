<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BatchMaster extends Model
{
    public function batchSource()
    {
        return $this->belongsTo(BatchSource::class);
    }

    public function numberRange()
    {
        return $this->belongsTo(NumberRange::class);
    }

    public function businessPartner()
    {
        return $this->belongsTo(BusinessPartner::class);
    }

    public function materialMasters()
    {
        return $this->belongsToMany(MaterialMaster::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->batch_number;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->batch_number;
        });
    }

    use log;
}
