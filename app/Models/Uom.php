<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    public function materialMasters()
    {
        return $this->hasMany(MaterialMaster::class, 'base_uom_id');
    }

    public function materialMasters2()
    {
        return $this->hasMany(MaterialMaster::class, 'weight_unit_id');
    }

    public function bomHeaders()
    {
        return $this->hasMany(BomHeader::class);
    }

    public function bomItems()
    {
        return $this->hasMany(BomItem::class);
    }

    use log;
}
