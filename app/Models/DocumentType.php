<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    public function numberRange()
    {
        return $this->belongsTo(NumberRange::class);
    }

    public function moduleCaa()
    {
        return $this->belongsTo(ModuleCaa::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function documentTypes()
    {
        return $this->hasMany(DocumentType::class);
    }

    public function statusGroup()
    {
        return $this->belongsTo(StatusGroup::class);
    }

    public function documentTypeItemCategories()
    {
        return $this->hasMany(DocumentTypeItemCategory::class);
    }

    public function itemCategories()
    {
        return $this->belongsToMany(ItemCategory::class);
    }

    use log;
}
