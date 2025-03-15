<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{

    public function bpCategoryTitles()
    {
        return $this->hasMany(BpCategoryTitle::class);
    }

    public function businessPartners()
    {
        return $this->hasMany(BusinessPartner::class);
    }

    public function bpCategories()
    {
        return $this->belongsToMany(BpCategory::class);
    }

    use log;
}
