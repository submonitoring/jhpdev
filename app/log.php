<?php

namespace App;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Facades\Auth;
use Kenepa\ResourceLock\Models\Concerns\HasLocks;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait log
{
    use LogsActivity;
    use HasLocks;
    use HasUlids;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function uniqueIds()
    {
        // Tell Laravel you want to use ULID for your secondary 'ulid' column instead
        return [
            'unique',
        ];
    }

    public function getRouteKeyName()
    {
        return 'unique';
    }
}
