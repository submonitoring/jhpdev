<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;

class StatusStatusGroup extends Model
{
    protected $table = 'status_status_group';

    public function statusGroup()
    {
        return $this->belongsTo(StatusGroup::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    use log;
}
