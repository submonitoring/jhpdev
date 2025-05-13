<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ModuleAaa extends Model
{
    public function applicationPaths()
    {
        return $this->hasMany(ApplicationPath::class);
    }

    public function applicationName()
    {
        return $this->belongsTo(ApplicationName::class);
    }

    public function moduleBaas()
    {
        return $this->hasMany(ModuleBaa::class);
    }

    public function documentTypes()
    {
        return $this->hasMany(DocumentType::class);
    }

    public function accountDeterminations()
    {
        return $this->hasMany(AccountDetermination::class);
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
            $model->record_title = $model->module_aaa_name;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->module_aaa_name;
        });
    }

    use log;
}
