<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BatchMasterMaterialMaster extends Model
{
    protected $table = 'batch_master_material_master';

    public function batchMaster()
    {
        return $this->belongsTo(BatchMaster::class);
    }

    public function materialMaster()
    {
        return $this->belongsTo(MaterialMaster::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->batchMaster->batch_number;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->batchMaster->batch_number;
        });
    }

    use log;
}
