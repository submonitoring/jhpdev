<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SalesArea extends Model
{
    public function salesOrganization()
    {
        return $this->belongsTo(SalesOrganization::class);
    }

    public function distributionChannel()
    {
        return $this->belongsTo(DistributionChannel::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function salesAreaSalesOffices()
    {
        return $this->hasMany(SalesAreaSalesOffice::class);
    }

    public function salesOffices()
    {
        return $this->belongsToMany(SalesOffice::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->salesOrganization->sales_organization_name . ' ' . $model->distributionChannel->distribution_channel_name . ' ' . $model->division->division_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->salesOrganization->sales_organization_name . ' ' . $model->distributionChannel->distribution_channel_name . ' ' . $model->division->division_name;
        });
    }

    use log;
}
