<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactCompany extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'contact_companies';

    public static $searchable = [
        'company_vat',
        'company_phone',
    ];

    protected $dates = [
        'last_use',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'defaulter',
        'company_name',
        'company_vat',
        'company_address',
        'company_mobile',
        'company_phone',
        'company_email',
        'company_website',
        'company_social_link',
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

    public function companyProviders()
    {
        return $this->hasMany(Provider::class, 'company_id', 'id');
    }

    public function companyInsurances()
    {
        return $this->hasMany(Insurance::class, 'company_id', 'id');
    }

    public function contacts()
    {
        return $this->belongsToMany(ContactContact::class);
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
