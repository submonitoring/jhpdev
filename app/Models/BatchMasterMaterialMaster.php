<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class BatchMasterMaterialMaster extends Model
{
    protected $table = 'batch_master_material_master';

    public function batchMaster()
    {
        return $this->belongsTo(BatchMaster::class);
    }

    public function materialMaster()
    {
        return $this->belongsTo(MaterialMaster::class);
    }

    use log;
}
