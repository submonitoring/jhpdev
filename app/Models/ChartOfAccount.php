<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    public function glAccountGroups()
    {
        return $this->hasMany(GlAccountGroup::class);
    }

    public function companyCodes()
    {
        return $this->hasMany(CompanyCode::class);
    }

    use log;
}
