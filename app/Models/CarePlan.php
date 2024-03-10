<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarePlan extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'care_plans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PERIOD_RADIO = [
        'monthly'      => 'Monthly',
        'quarterly'    => 'Quarterly',
        'semiannually' => 'Semi-Annually',
        'annually'     => 'Annually',
        'biennially'   => 'Biennially',
        'onetime'      => 'One-Time',
    ];

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'period',
        'period_price',
        'seo_title',
        'seo_meta_description',
        'seo_slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function carePlanMaintenanceSuscriptions()
    {
        return $this->hasMany(MaintenanceSuscription::class, 'care_plan_id', 'id');
    }

    public function checkpoints()
    {
        return $this->belongsToMany(Checkpoint::class);
    }
}
