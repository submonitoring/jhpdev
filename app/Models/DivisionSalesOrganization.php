<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DivisionSalesOrganization extends Model
{
    protected $table = 'division_sales_organization';

    public function division()
    {
        return $this->belongsTo(Division::class);
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
            $model->record_title = $model->division->division_name . ' ' . $model->salesOrganization->sales_organization_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->division->division_name . ' ' . $model->salesOrganization->sales_organization_name;
        });
    }

    use log;
}
