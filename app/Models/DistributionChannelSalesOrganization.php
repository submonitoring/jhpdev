<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DistributionChannelSalesOrganization extends Model
{
    protected $table = 'distribution_channel_sales_organization';

    public function distributionChannel()
    {
        return $this->belongsTo(DistributionChannel::class);
    }

    public function salesOrganization()
    {
        return $this->belongsTo(SalesOrganization::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->distributionChannel->distribution_channel_name . ' ' . $model->salesOrganization->sales_organization_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->distributionChannel->distribution_channel_name . ' ' . $model->salesOrganization->sales_organization_name;
        });
    }

    use log;
}
