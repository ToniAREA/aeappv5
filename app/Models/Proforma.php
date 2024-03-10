<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proforma extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'proformas';

    protected $dates = [
        'date',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'proforma_number',
        'closed_and_protected',
        'invoice_link',
        'client_id',
        'date',
        'description',
        'total_amount',
        'currency',
        'sent',
        'paid',
        'claims',
        'link',
        'link_description',
        'status',
        'notes',
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

    public function proformaNumberWlogs()
    {
        return $this->hasMany(Wlog::class, 'proforma_number_id', 'id');
    }

    public function proformaNumberClaims()
    {
        return $this->hasMany(Claim::class, 'proforma_number_id', 'id');
    }

    public function proformaNumberPayments()
    {
        return $this->hasMany(Payment::class, 'proforma_number_id', 'id');
    }

    public function proformaNumberMlogs()
    {
        return $this->hasMany(Mlog::class, 'proforma_number_id', 'id');
    }

    public function proformaAssetsRentals()
    {
        return $this->hasMany(AssetsRental::class, 'proforma_id', 'id');
    }

    public function proformaClientsReviews()
    {
        return $this->hasMany(ClientsReview::class, 'proforma_id', 'id');
    }

    public function proformaSuscriptions()
    {
        return $this->hasMany(Suscription::class, 'proforma_id', 'id');
    }

    public function proformaMaintenanceSuscriptions()
    {
        return $this->hasMany(MaintenanceSuscription::class, 'proforma_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function boats()
    {
        return $this->belongsToMany(Boat::class);
    }

    public function wlists()
    {
        return $this->belongsToMany(Wlist::class);
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
