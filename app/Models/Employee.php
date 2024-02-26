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

class Employee extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'employees';

    protected $appends = [
        'photo',
    ];

    public static $searchable = [
        'status',
        'notes',
        'internalnotes',
    ];

    protected $dates = [
        'contract_starts',
        'contract_ends',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_employee',
        'namecomplete',
        'user_id',
        'contact_id',
        'status',
        'contract_starts',
        'contract_ends',
        'category',
        'notes',
        'internalnotes',
        'link',
        'link_description',
        'active',
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

    public function employeeBookingLists()
    {
        return $this->hasMany(BookingList::class, 'employee_id', 'id');
    }

    public function forEmployeeToDos()
    {
        return $this->hasMany(ToDo::class, 'for_employee_id', 'id');
    }

    public function employeeExpenses()
    {
        return $this->hasMany(Expense::class, 'employee_id', 'id');
    }

    public function employeeIncomes()
    {
        return $this->hasMany(Income::class, 'employee_id', 'id');
    }

    public function employeeBookingSlots()
    {
        return $this->hasMany(BookingSlot::class, 'employee_id', 'id');
    }

    public function employeeEmployeeAttendances()
    {
        return $this->hasMany(EmployeeAttendance::class, 'employee_id', 'id');
    }

    public function employeeEmployeeHolidays()
    {
        return $this->hasMany(EmployeeHoliday::class, 'employee_id', 'id');
    }

    public function employeeEmployeeSkills()
    {
        return $this->hasMany(EmployeeSkill::class, 'employee_id', 'id');
    }

    public function employeeEmployeeRatings()
    {
        return $this->hasMany(EmployeeRating::class, 'employee_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contact()
    {
        return $this->belongsTo(ContactContact::class, 'contact_id');
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getContractStartsAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setContractStartsAttribute($value)
    {
        $this->attributes['contract_starts'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getContractEndsAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setContractEndsAttribute($value)
    {
        $this->attributes['contract_ends'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
