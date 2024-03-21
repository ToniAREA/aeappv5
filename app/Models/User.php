<?php

namespace App\Models;

use App\Notifications\VerifyUserNotification;
use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, Auditable, HasFactory;

    public $table = 'users';

    protected $hidden = [
        'remember_token', 'two_factor_code',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'two_factor_expires_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'two_factor',
        'password',
        'verified',
        'verified_at',
        'verification_token',
        'approved',
        'two_factor_code',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'two_factor_expires_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (self $user) {
            if (auth()->check()) {
                $user->verified    = 1;
                $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
                $user->save();
            } elseif (! $user->verification_token) {
                $token     = Str::random(64);
                $usedToken = self::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token     = Str::random(64);
                    $usedToken = self::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;
                $user->save();

                $registrationRole = config('panel.registration_default_role');
                if (! $user->roles()->get()->contains($registrationRole)) {
                    $user->roles()->attach($registrationRole);
                }

                $user->notify(new VerifyUserNotification($user));
            }
        });
    }

    public static function boot()
    {
        parent::boot();
        self::observe(new \App\Observers\UserActionObserver);
    }

    public function userEmployees()
    {
        return $this->hasMany(Employee::class, 'user_id', 'id');
    }

    public function employeeWlogs()
    {
        return $this->hasMany(Wlog::class, 'employee_id', 'id');
    }

    public function fromUserWlists()
    {
        return $this->hasMany(Wlist::class, 'from_user_id', 'id');
    }

    public function fromUserComments()
    {
        return $this->hasMany(Comment::class, 'from_user_id', 'id');
    }

    public function userBookingLists()
    {
        return $this->hasMany(BookingList::class, 'user_id', 'id');
    }

    public function actualHolderAssets()
    {
        return $this->hasMany(Asset::class, 'actual_holder_id', 'id');
    }

    public function employeeMlogs()
    {
        return $this->hasMany(Mlog::class, 'employee_id', 'id');
    }

    public function userAssetsRentals()
    {
        return $this->hasMany(AssetsRental::class, 'user_id', 'id');
    }

    public function userSuscriptions()
    {
        return $this->hasMany(Suscription::class, 'user_id', 'id');
    }

    public function userMaintenanceSuscriptions()
    {
        return $this->hasMany(MaintenanceSuscription::class, 'user_id', 'id');
    }

    public function fromUserEmployeeRatings()
    {
        return $this->hasMany(EmployeeRating::class, 'from_user_id', 'id');
    }

    public function userIotSuscriptions()
    {
        return $this->hasMany(IotSuscription::class, 'user_id', 'id');
    }

    public function userUserSettings()
    {
        return $this->hasMany(UserSetting::class, 'user_id', 'id');
    }

    public function userWaitingLists()
    {
        return $this->hasMany(WaitingList::class, 'user_id', 'id');
    }

    public function authorizedUsersProductCategories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function authorizedUsersAssetCategories()
    {
        return $this->belongsToMany(AssetCategory::class);
    }

    public function authorizedUsersContentCategories()
    {
        return $this->belongsToMany(ContentCategory::class);
    }

    public function authorizedUsersTechnicalDocumentations()
    {
        return $this->belongsToMany(TechnicalDocumentation::class);
    }

    public function authorizedUsersDocumentationCategories()
    {
        return $this->belongsToMany(DocumentationCategory::class);
    }

    public function authorizedUsersContentPages()
    {
        return $this->belongsToMany(ContentPage::class);
    }

    public function authorizedUsersTechDocsTypes()
    {
        return $this->belongsToMany(TechDocsType::class);
    }

    public function authorizedUsersVideoTutorials()
    {
        return $this->belongsToMany(VideoTutorial::class);
    }

    public function authorizedUsersFaqCategories()
    {
        return $this->belongsToMany(FaqCategory::class);
    }

    public function authorizedUsersFaqQuestions()
    {
        return $this->belongsToMany(FaqQuestion::class);
    }

    public function authorizedUsersVideoCategories()
    {
        return $this->belongsToMany(VideoCategory::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getTwoFactorExpiresAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTwoFactorExpiresAtAttribute($value)
    {
        $this->attributes['two_factor_expires_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
