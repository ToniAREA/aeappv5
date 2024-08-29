<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeRating extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'employee_ratings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'employee_id',
        'from_user_id',
        'from_client_id',
        'for_wlist_id',
        'for_wlog_id',
        'rating',
        'comment',
        'show_online',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function from_user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function from_client()
    {
        return $this->belongsTo(Client::class, 'from_client_id');
    }

    public function for_wlist()
    {
        return $this->belongsTo(Wlist::class, 'for_wlist_id');
    }

    public function for_wlog()
    {
        return $this->belongsTo(Wlog::class, 'for_wlog_id');
    }
}
