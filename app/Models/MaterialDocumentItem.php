<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MaterialDocumentItem extends Model
{
    public function materialMaster()
    {
        return $this->belongsTo(MaterialMaster::class);
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class);
    }

    public function movementType()
    {
        return $this->belongsTo(MovementType::class);
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function toPlant()
    {
        return $this->belongsTo(Plant::class, 'to_plant_id');
    }

    public function materialDocument()
    {
        return $this->belongsTo(MaterialDocument::class);
    }

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->material_document_id;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->material_document_id;
        });
    }

    use log;
}
