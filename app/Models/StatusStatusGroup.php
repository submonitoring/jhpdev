<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StatusStatusGroup extends Model
{
    protected $table = 'status_status_group';

    public function statusGroup()
    {
        return $this->belongsTo(StatusGroup::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->status->status . ' ' . $model->statusGroup->status_group_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->status->status . ' ' . $model->statusGroup->status_group_name;
        });
    }

    use log;
}
