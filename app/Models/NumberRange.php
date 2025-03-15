<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

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

    use log;
}
