<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DocumentTypeItemCategory extends Model
{
    protected $table = 'document_type_item_category';

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function itemCategory()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->documentType->document_type_desc . ' ' . $model->itemCategory->item_category_desc;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->documentType->document_type_desc . ' ' . $model->itemCategory->item_category_desc;
        });
    }

    use log;
}
