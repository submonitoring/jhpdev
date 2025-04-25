<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SalesGroupSalesOffice extends Model
{
    protected $table = 'sales_group_sales_office';

    public function salesGroup()
    {
        return $this->belongsTo(SalesGroup::class);
    }

    public function salesOffice()
    {
        return $this->belongsTo(SalesOffice::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->salesGroup->sales_group_name . ' ' . $model->salesOffice->sales_office_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->salesGroup->sales_group_name . ' ' . $model->salesOffice->sales_office_name;
        });
    }

    use log;
}
