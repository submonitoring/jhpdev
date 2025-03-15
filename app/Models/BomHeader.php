<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class BomHeader extends Model
{
    public function materialMaster()
    {
        return $this->belongsTo(MaterialMaster::class);
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class);
    }

    public function bomItems()
    {
        return $this->hasMany(BomItem::class);
    }

    use log;
}
