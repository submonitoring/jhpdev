<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AccountDeterminationItem extends Model
{
    public function accountDetermination()
    {
        return $this->belongsTo(AccountDetermination::class);
    }

    public function glAccount()
    {
        return $this->belongsTo(GlAccount::class);
    }

    public function debitCredit()
    {
        return $this->belongsTo(DebitCredit::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->account_determination_id;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->account_determination_id;
        });
    }

    use log;
}
