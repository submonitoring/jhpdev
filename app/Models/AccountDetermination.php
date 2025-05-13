<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AccountDetermination extends Model
{
    public function moduleAaa()
    {
        return $this->belongsTo(ModuleAaa::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function materialType()
    {
        return $this->belongsTo(MaterialType::class);
    }

    public function movementType()
    {
        return $this->belongsTo(MovementType::class);
    }

    public function accountDeterminationItems()
    {
        return $this->hasMany(AccountDeterminationItem::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->id;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->id;
        });
    }

    use log;
}
