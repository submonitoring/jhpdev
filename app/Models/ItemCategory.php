<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ItemCategory extends Model
{
    public function documentTypeItemCategories()
    {
        return $this->hasMany(DocumentTypeItemCategory::class);
    }

    public function documentTypes()
    {
        return $this->belongsToMany(DocumentType::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->item_category_desc;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->item_category_desc;
        });
    }

    use log;
}
