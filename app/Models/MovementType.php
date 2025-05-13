<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MovementType extends Model
{
    public function materialDocumentItems()
    {
        return $this->hasMany(MaterialDocumentItem::class);
    }

    public function accountDeterminations()
    {
        return $this->hasMany(AccountDetermination::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->movement_type;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->movement_type;
        });
    }

    use log;
}
