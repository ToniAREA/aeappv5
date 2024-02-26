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

class Marina extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'marinas';

    public static $searchable = [
        'name',
    ];

    protected $appends = [
        'marina_photo',
    ];

    protected $dates = [
        'last_use',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'coordinates',
        'link',
        'link_description',
        'notes',
        'internal_notes',
        'contact_docs_id',
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

    public function marinaBoats()
    {
        return $this->hasMany(Boat::class, 'marina_id', 'id');
    }

    public function marinaWlogs()
    {
        return $this->hasMany(Wlog::class, 'marina_id', 'id');
    }

    public function getMarinaPhotoAttribute()
    {
        $file = $this->getMedia('marina_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function contact_docs()
    {
        return $this->belongsTo(ContactContact::class, 'contact_docs_id');
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
