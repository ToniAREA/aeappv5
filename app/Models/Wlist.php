<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Wlist extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'wlists';

    protected $appends = [
        'photos',
    ];

    public static $searchable = [
        'internal_notes',
    ];

    protected $dates = [
        'deadline',
        'last_use',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const ORDER_TYPE_RADIO = [
        'request'  => 'Request',
        'estimate' => 'Estimate',
        'order'    => 'Order',
        'work'     => 'Work',
        'other'    => 'Other',
    ];

    protected $fillable = [
        'client_id',
        'order_type',
        'boat_id',
        'from_user_id',
        'for_employee_id',
        'boat_namecomplete',
        'description',
        'estimated_hours',
        'deadline',
        'status_id',
        'priority',
        'proforma_link',
        'notes',
        'internal_notes',
        'link',
        'link_description',
        'last_use',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function wlistWlogs()
    {
        return $this->hasMany(Wlog::class, 'wlist_id', 'id');
    }

    public function wlistComments()
    {
        return $this->hasMany(Comment::class, 'wlist_id', 'id');
    }

    public function wlistMlogs()
    {
        return $this->hasMany(Mlog::class, 'wlist_id', 'id');
    }

    public function forWlistEmployeesRatings()
    {
        return $this->hasMany(EmployeesRating::class, 'for_wlist_id', 'id');
    }

    public function wlistsAppointments()
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function wlistsProformas()
    {
        return $this->belongsToMany(Proforma::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function boat()
    {
        return $this->belongsTo(Boat::class, 'boat_id');
    }

    public function from_user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function for_roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function for_employee()
    {
        return $this->belongsTo(Employee::class, 'for_employee_id');
    }

    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getDeadlineAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function status()
    {
        return $this->belongsTo(WlistStatus::class, 'status_id');
    }

    public function getLastUseAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setLastUseAttribute($value)
    {
        $this->attributes['last_use'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getCompletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setCompletedAtAttribute($value)
    {
        $this->attributes['completed_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
