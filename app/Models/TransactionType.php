<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TransactionType extends Model
{
    public function materialDocuments()
    {
        return $this->hasMany(MaterialDocument::class);
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
            $model->record_title = $model->transaction_type_dsec;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->transaction_type_dsec;
        });
    }

    use log;
}
