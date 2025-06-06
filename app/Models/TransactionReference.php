<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TransactionReference extends Model
{
    public function materialDocuments()
    {
        return $this->hasMany(MaterialDocument::class);
    }

    public function materialDocumentCopyControls()
    {
        return $this->hasMany(MaterialDocumentCopyControl::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->transaction_reference_desc;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->transaction_reference_desc;
        });
    }

    use log;
}
