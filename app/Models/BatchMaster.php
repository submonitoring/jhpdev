<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class BatchMaster extends Model
{
    public function batchSource()
    {
        return $this->belongsTo(BatchSource::class);
    }

    public function numberRange()
    {
        return $this->belongsTo(NumberRange::class);
    }

    public function businessPartner()
    {
        return $this->belongsTo(BusinessPartner::class);
    }

    public function materialMasters()
    {
        return $this->belongsToMany(MaterialMaster::class);
    }

    use log;
}
