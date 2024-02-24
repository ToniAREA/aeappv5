<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetsRental extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'assets_rentals';

    protected $dates = [
        'start_date',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const RENTAL_UNIT_SELECT = [
        'hours'  => 'Hours',
        'days'   => 'Days',
        'weeks'  => 'Weeks',
        'months' => 'Months',
        'years'  => 'Years',
    ];

    protected $fillable = [
        'asset_id',
        'user_id',
        'client_id',
        'boat_id',
        'start_date',
        'end_date',
        'rental_details',
        'active',
        'invoiced',
        'proforma_id',
        'link',
        'link_description',
        'completed_at',
        'rental_unit',
        'rental_quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function boat()
    {
        return $this->belongsTo(Boat::class, 'boat_id');
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function proforma()
    {
        return $this->belongsTo(Proforma::class, 'proforma_id');
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
