<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'clients';

    public static $searchable = [
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
        'has_active_vip_plan',
        'has_active_maintenance_plan',
        'defaulter',
        'ref',
        'name',
        'lastname',
        'vat',
        'address',
        'country',
        'telephone',
        'mobile',
        'email',
        'notes',
        'internal_notes',
        'coordinates',
        'link_a',
        'link_a_description',
        'link_b',
        'link_b_description',
        'last_use',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function clientWlists()
    {
        return $this->hasMany(Wlist::class, 'client_id', 'id');
    }

    public function clientAppointments()
    {
        return $this->hasMany(Appointment::class, 'client_id', 'id');
    }

    public function clientBookingLists()
    {
        return $this->hasMany(BookingList::class, 'client_id', 'id');
    }

    public function clientAssetsRentals()
    {
        return $this->hasMany(AssetsRental::class, 'client_id', 'id');
    }

    public function clientClientsReviews()
    {
        return $this->hasMany(ClientsReview::class, 'client_id', 'id');
    }

    public function clientSuscriptions()
    {
        return $this->hasMany(Suscription::class, 'client_id', 'id');
    }

    public function clientMaintenanceSuscriptions()
    {
        return $this->hasMany(MaintenanceSuscription::class, 'client_id', 'id');
    }

    public function fromClientEmployeeRatings()
    {
        return $this->hasMany(EmployeeRating::class, 'from_client_id', 'id');
    }

    public function clientIotSuscriptions()
    {
        return $this->hasMany(IotSuscription::class, 'client_id', 'id');
    }

    public function clientFinalcialDocuments()
    {
        return $this->hasMany(FinalcialDocument::class, 'client_id', 'id');
    }

    public function clientWaitingLists()
    {
        return $this->hasMany(WaitingList::class, 'client_id', 'id');
    }

    public function clientsBoats()
    {
        return $this->belongsToMany(Boat::class);
    }

    public function contacts()
    {
        return $this->belongsToMany(ContactContact::class);
    }

    public function boats()
    {
        return $this->belongsToMany(Boat::class);
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
