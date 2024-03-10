<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IotReceivedData extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'iot_received_datas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'device_id',
        'security_token',
        'received_data',
        'service_voltage',
        'engine_1_voltage',
        'engine_2_voltage',
        'bilge_alarm',
        'shore_alarm',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function device()
    {
        return $this->belongsTo(IotDevice::class, 'device_id');
    }
}
