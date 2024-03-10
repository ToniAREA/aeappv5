<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IotDevice extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'iot_devices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_RADIO = [
        'available'   => 'Available',
        'busy'        => 'Busy',
        'offline'     => 'Offline',
        'maintenance' => 'Maintenance',
        'other'       => 'Other',
    ];

    protected $fillable = [
        'name',
        'device',
        'is_active',
        'product_id',
        'security_token',
        'serial_number',
        'status',
        'additional_info',
        'source_code_link',
        'notes',
        'internal_notes',
        'link',
        'link_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function deviceIotSuscriptions()
    {
        return $this->hasMany(IotSuscription::class, 'device_id', 'id');
    }

    public function deviceIotReceivedDatas()
    {
        return $this->hasMany(IotReceivedData::class, 'device_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
