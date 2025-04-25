<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NumberRange extends Model
{
    public function nrObject()
    {
        return $this->belongsTo(NrObject::class);
    }

    public function documentTypes()
    {
        return $this->hasMany(DocumentType::class);
    }

    public function materialTypes()
    {
        return $this->hasMany(MaterialType::class);
    }

    public function batchSources()
    {
        return $this->hasMany(BatchSource::class);
    }

    public function businessPartners()
    {
        return $this->hasMany(BusinessPartner::class);
    }

    public function batchMasters()
    {
        return $this->hasMany(BatchMaster::class);
    }

    public function bomTypes()
    {
        return $this->hasMany(BomType::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->number_range_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->number_range_name;
        });
    }

    use log;
}
