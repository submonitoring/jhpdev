<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

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

    use log;
}
