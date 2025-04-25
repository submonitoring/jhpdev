<?php

namespace App\Models;

use App\log;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kenepa\ResourceLock\Models\Concerns\HasLocks;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PanelRole extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = $user->username;
            $model->updated_by = $user->username;
            $model->record_title = $model->panel_role;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = $user->username;
            $model->record_title = $model->panel_role;
        });

        // static::created(function ($model) {

        //     $recipient = auth()->user();
        //     $recipienta = User::find(1);

        //     Notification::make()
        //         ->title($model->record_title .  ' created by ' . $recipient->username)
        //         ->sendToDatabase([$recipient, $recipienta]);
        // });
    }

    use log;
}
