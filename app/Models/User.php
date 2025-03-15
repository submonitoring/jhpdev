<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\log;
use Auth;
use Carbon\Traits\LocalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable as TraitsTwoFactorAuthenticatable;
use Kenepa\ResourceLock\Models\Concerns\HasLocks;
use Request;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use TomatoPHP\FilamentAlerts\Traits\InteractsWithNotifications;
use TomatoPHP\FilamentSocial\Traits\InteractsWithSocials;
use Wildside\Userstamps\Userstamps;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $panel
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read string $profile_photo_url
 * @property-read \App\Models\Membership $membership
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePanel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property int|null $is_active
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Kenepa\ResourceLock\Models\ResourceLock|null $resourceLock
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TraitsTwoFactorAuthenticatable;
    use HasRoles;
    use InteractsWithNotifications;
    // use InteractsWithSocials;

    public function canAccessPanel(Panel $panel): bool
    {

        switch ($panel->getId()) {
            case 'submonitoring':
                return auth()->user()->panel_role_id == 1;
            case 'jhpadmin':
                return auth()->user()->panel_role_id == 2 || auth()->user()->panel_role_id == 1;
            default:
                return true;
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'panel_role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'canviewany_id' => 'array',
            'cancreate_id' => 'array',
            'canupdate_id' => 'array',
            'canview_id' => 'array',
            'candelete_id' => 'array',
            'canforcedelete_id' => 'array',
            'canforcedeleteany_id' => 'array',
            'canrestore_id' => 'array',
            'canrestoreany_id' => 'array',
            'canreorder_id' => 'array',
        ];
    }

    public function getRedirectRoute(): string
    {
        return match ((int)$this->panel_role_id) {
            1 => 'submonitoring',
            2 => 'jhpadmin',
            3 => '/'
        };
    }

    public function panelRole()
    {
        return $this->belongsTo(PanelRole::class);
    }

    public function canViewAny()
    {
        return $this->belongsTo(ApplicationPath::class, 'canviewany_id');
    }

    public function canCreate()
    {
        return $this->belongsTo(ApplicationPath::class, 'cancreate_id');
    }

    public function canUpdate()
    {
        return $this->belongsTo(ApplicationPath::class, 'canupdate_id');
    }

    public function canView()
    {
        return $this->belongsTo(ApplicationPath::class, 'canview_id');
    }

    public function canDelete()
    {
        return $this->belongsTo(ApplicationPath::class, 'candelete_id');
    }

    public function canForceDelete()
    {
        return $this->belongsTo(ApplicationPath::class, 'canforcedelete_id');
    }

    public function canForceDeleteAny()
    {
        return $this->belongsTo(ApplicationPath::class, 'canforcedeleteany_id');
    }

    public function canRestore()
    {
        return $this->belongsTo(ApplicationPath::class, 'canrestore_id');
    }

    public function canRestoreAny()
    {
        return $this->belongsTo(ApplicationPath::class, 'canrestoreany_id');
    }

    public function canReorder()
    {
        return $this->belongsTo(ApplicationPath::class, 'canreorder_id');
    }

    use log;

    use HasUlids;

    public function uniqueIds()
    {
        // Tell Laravel you want to use ULID for your secondary 'ulid' column instead
        return [
            'unique',
        ];
    }

    public function getRouteKeyName()
    {
        return 'unique';
    }
}
