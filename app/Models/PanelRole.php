<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Kenepa\ResourceLock\Models\Concerns\HasLocks;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PanelRole extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    use log;
}
