<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CompanyCode extends Model
{
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }

    public function purchasingOrganizations()
    {
        return $this->hasMany(PurchasingOrganization::class);
    }

    public function chartOfAccount()
    {
        return $this->belongsTo(ChartOfAccount::class);
    }

    public function salesOrganizations()
    {
        return $this->hasMany(SalesOrganization::class);
    }

    public function businessPartnerCompanies()
    {
        return $this->hasMany(BusinessPartnerCompany::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->company_code_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->company_code_name;
        });
    }

    use log;
}
