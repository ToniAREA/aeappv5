<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'appointments';

    public static $searchable = [
        'private_comment',
    ];

    protected $dates = [
        'when_starts',
        'when_ends',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'client_id',
        'boat_id',
        'boat_namecomplete',
        'in_marina_id',
        'description',
        'private_comment',
        'when_starts',
        'when_ends',
        'priority',
        'status',
        'notes',
        'coordinates',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function boat()
    {
        return $this->belongsTo(Boat::class, 'boat_id');
    }

    public function wlists()
    {
        return $this->belongsToMany(Wlist::class);
    }

    public function for_roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function for_employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function in_marina()
    {
        return $this->belongsTo(Marina::class, 'in_marina_id');
    }

    public function getWhenStartsAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setWhenStartsAttribute($value)
    {
        $this->attributes['when_starts'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getWhenEndsAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setWhenEndsAttribute($value)
    {
        $this->attributes['when_ends'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
