<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SalesOffice extends Model
{
    public function salesAreaSalesOffices()
    {
        return $this->hasMany(SalesAreaSalesOffice::class);
    }

    public function salesGroupSalesOffices()
    {
        return $this->hasMany(SalesGroupSalesOffice::class);
    }

    public function salesAreas()
    {
        return $this->belongsToMany(SalesArea::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->sales_office_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->sales_office_name;
        });
    }

    use log;
}
