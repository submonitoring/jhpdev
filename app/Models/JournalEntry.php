<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class JournalEntry extends Model
{
    public function materialDocumentItem()
    {
        return $this->belongsTo(MaterialDocumentItem::class);
    }

    public function moduleAaa()
    {
        return $this->belongsTo(ModuleAaa::class);
    }

    public function debitCredit()
    {
        return $this->belongsTo(DebitCredit::class);
    }

    public function glAccount()
    {
        return $this->belongsTo(GlAccount::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->id;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->id;
        });
    }

    use log;
}
