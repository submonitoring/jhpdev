<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ChartOfAccount extends Model
{
    public function glAccountGroups()
    {
        return $this->hasMany(GlAccountGroup::class);
    }

    public function companyCodes()
    {
        return $this->hasMany(CompanyCode::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->chart_of_account_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->chart_of_account_name;
        });
    }

    use log;
}
