<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
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
