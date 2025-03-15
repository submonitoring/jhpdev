<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class);
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
