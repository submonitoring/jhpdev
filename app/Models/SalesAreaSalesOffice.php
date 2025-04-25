<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SalesAreaSalesOffice extends Model
{
    protected $table = 'sales_area_sales_office';

    public function salesArea()
    {
        return $this->belongsTo(SalesArea::class);
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
            $model->record_title = $model->salesArea->salesOrganization->sales_organization_name . ' ' . $model->salesArea->distributionChannel->distribution_channel_name . ' ' . $model->salesArea->division->division_name->$model->salesOffice->sales_office_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->salesArea->salesOrganization->sales_organization_name . ' ' . $model->salesArea->distributionChannel->distribution_channel_name . ' ' . $model->salesArea->division->division_name->$model->salesOffice->sales_office_name;
        });
    }

    use log;
}
