<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ToDo extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    public $table = 'to_dos';

    protected $appends = [
        'photos',
    ];

    public static $searchable = [
        'internal_notes',
    ];

    protected $dates = [
        'deadline',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const REPEAT_INTERVAL_UNIT_SELECT = [
        'day'   => 'Day',
        'week'  => 'Week',
        'month' => 'Month',
        'year'  => 'Year',
    ];

    protected $fillable = [
        'task',
        'notes',
        'for_employee_id',
        'deadline',
        'priority',
        'is_repetitive',
        'repeat_interval_value',
        'repeat_interval_unit',
        'internal_notes',
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

    public function for_roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function for_employee()
    {
        return $this->belongsTo(Employee::class, 'for_employee_id');
    }

    public function getDeadlineAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
