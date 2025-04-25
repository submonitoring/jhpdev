<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Division extends Model
{
    public function divisionSalesOrganizations()
    {
        return $this->hasMany(DivisionSalesOrganization::class);
    }

    public function salesAreas()
    {
        return $this->hasMany(SalesArea::class);
    }

    public function businessPartnerCustomers()
    {
        return $this->hasMany(BusinessPartnerCustomer::class);
    }

    public function allMaterialMasterSales()
    {
        return $this->hasMany(MaterialMasterSales::class);
    }

    public function salesOrganizations()
    {
        return $this->belongsToMany(SalesOrganization::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->division_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->division_name;
        });
    }

    use log;
}
