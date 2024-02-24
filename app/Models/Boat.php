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

class Boat extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'boats';

    protected $appends = [
        'boat_photo',
    ];

    public static $searchable = [
        'ref',
        'mmsi',
        'notes',
        'internal_notes',
    ];

    protected $dates = [
        'last_use',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ref',
        'boat_type',
        'name',
        'imo',
        'mmsi',
        'marina_id',
        'notes',
        'internal_notes',
        'coordinates',
        'link',
        'link_description',
        'last_use',
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

    public function boatWlists()
    {
        return $this->hasMany(Wlist::class, 'boat_id', 'id');
    }

    public function boatAppointments()
    {
        return $this->hasMany(Appointment::class, 'boat_id', 'id');
    }

    public function boatBookingLists()
    {
        return $this->hasMany(BookingList::class, 'boat_id', 'id');
    }

    public function boatMlogs()
    {
        return $this->hasMany(Mlog::class, 'boat_id', 'id');
    }

    public function boatAssetsRentals()
    {
        return $this->hasMany(AssetsRental::class, 'boat_id', 'id');
    }

    public function boatsClients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function boatsProformas()
    {
        return $this->belongsToMany(Proforma::class);
    }

    public function boatsClientsReviews()
    {
        return $this->belongsToMany(ClientsReview::class);
    }

    public function getBoatPhotoAttribute()
    {
        $file = $this->getMedia('boat_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function marina()
    {
        return $this->belongsTo(Marina::class, 'marina_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function getLastUseAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setLastUseAttribute($value)
    {
        $this->attributes['last_use'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
