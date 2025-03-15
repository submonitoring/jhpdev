<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

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

    use log;
}
