<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MaterialDocument extends Model
{
    public function businessPartner()
    {
        return $this->belongsTo(BusinessPartner::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function numberRange()
    {
        return $this->belongsTo(NumberRange::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function transactionReference()
    {
        return $this->belongsTo(TransactionReference::class);
    }

    public function materialDocumentItems()
    {
        return $this->hasMany(MaterialDocumentItem::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->document_number;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->document_number;
        });
    }

    use log;
}
