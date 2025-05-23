<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MaterialMaster extends Model
{
    public function numberRange()
    {
        return $this->belongsTo(NumberRange::class);
    }

    public function materialType()
    {
        return $this->belongsTo(MaterialType::class);
    }

    public function industrySector()
    {
        return $this->belongsTo(IndustrySector::class);
    }

    public function materialGroup()
    {
        return $this->belongsTo(MaterialGroup::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function baseUom()
    {
        return $this->belongsTo(Uom::class, 'base_uom_id');
    }

    public function weightUnit()
    {
        return $this->belongsTo(Uom::class, 'weight_unit_id');
    }

    public function materialMasterPlants()
    {
        return $this->hasMany(MaterialMasterPlant::class);
    }

    public function allMaterialMasterSales()
    {
        return $this->hasMany(MaterialMasterSales::class);
    }

    public function bomHeaders()
    {
        return $this->hasMany(BomHeader::class);
    }

    public function bomItems()
    {
        return $this->hasMany(BomItem::class);
    }

    public function materialDocumentItems()
    {
        return $this->hasMany(MaterialDocumentItem::class);
    }

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    public function batchMasters()
    {
        return $this->belongsToMany(BatchMaster::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->material_number;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->material_number;
        });
    }

    use log;
}
