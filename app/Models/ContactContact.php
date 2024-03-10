<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactContact extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'contact_contacts';

    protected $dates = [
        'last_use',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'contact_nif',
        'contact_mobile',
        'contact_notes',
        'contact_internalnotes',
    ];

    protected $fillable = [
        'contact_first_name',
        'contact_last_name',
        'contact_nif',
        'contact_address',
        'contact_country',
        'contact_mobile',
        'contact_mobile_2',
        'contact_email',
        'contact_email_2',
        'social_link',
        'contact_tags',
        'contact_notes',
        'contact_internalnotes',
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

    public function contactEmployees()
    {
        return $this->hasMany(Employee::class, 'contact_id', 'id');
    }

    public function contactDocsMarinas()
    {
        return $this->hasMany(Marina::class, 'contact_docs_id', 'id');
    }

    public function contactsClients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function contactsContactCompanies()
    {
        return $this->belongsToMany(ContactCompany::class);
    }

    public function contactsMarinas()
    {
        return $this->belongsToMany(Marina::class);
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
