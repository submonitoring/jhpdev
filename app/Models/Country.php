<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function provinsis()
    {
        return $this->hasMany(Provinsi::class);
    }

    public function allKodepos()
    {
        return $this->hasMany(Kodepos::class);
    }

    public function businessPartners()
    {
        return $this->hasMany(BusinessPartner::class);
    }

    use log;
}
