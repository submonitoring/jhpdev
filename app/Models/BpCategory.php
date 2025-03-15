<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class BpCategory extends Model
{

    public function bpCategoryTitles()
    {
        return $this->hasMany(BpCategoryTitle::class);
    }

    public function businessPartners()
    {
        return $this->hasMany(BusinessPartner::class);
    }

    public function titles()
    {
        return $this->belongsToMany(Title::class);
    }

    use log;
}
