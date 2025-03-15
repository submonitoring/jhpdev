<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class GlAccount extends Model
{
    public function glAccountGroup()
    {
        return $this->belongsTo(GlAccountGroup::class);
    }

    use log;
}
