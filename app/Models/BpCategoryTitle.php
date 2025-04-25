<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BpCategoryTitle extends Model
{
    protected $table = 'bp_category_title';

    public function bpCategories()
    {
        return $this->belongsToMany(BpCategory::class);
    }

    public function titles()
    {
        return $this->belongsToMany(Title::class);
    }

    public function bpCategory()
    {
        return $this->belongsTo(BpCategory::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->bpCategory->bp_category_desc . ' ' . $model->title->title_desc;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->bpCategory->bp_category_desc . ' ' . $model->title->title_desc;
        });
    }

    use log;
}
