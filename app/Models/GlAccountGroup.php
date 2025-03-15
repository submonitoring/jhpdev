<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class GlAccountGroup extends Model
{
    public function glAccounts()
    {
        return $this->hasMany(GlAccount::class);
    }

    public function chartOfAccount()
    {
        return $this->belongsTo(ChartOfAccount::class);
    }

    use log;
}
