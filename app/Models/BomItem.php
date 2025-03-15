<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class BomItem extends Model
{
    public function materialMaster()
    {
        return $this->belongsTo(MaterialMaster::class);
    }

    public function bomHeader()
    {
        return $this->belongsTo(BomHeader::class);
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class);
    }

    use log;
}
