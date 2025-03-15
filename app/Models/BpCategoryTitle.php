<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class BpCategoryTitle extends Model
{
    protected $table = 'bp_category_title';

    public function bpCategories()
    {
        return $this->belongsToMany(BpCategory::class);
    }

    public function titles()
    {
        return $this->belongsToMany(Title::class);
    }

    public function bpCategory()
    {
        return $this->belongsTo(BpCategory::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }
}
