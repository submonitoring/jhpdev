<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GlAccount extends Model
{
    public function glAccountGroup()
    {
        return $this->belongsTo(GlAccountGroup::class);
    }

    public function accountDeterminationItems()
    {
        return $this->hasMany(AccountDeterminationItem::class);
    }

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->gl_account_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->gl_account_name;
        });
    }

    use log;
}
