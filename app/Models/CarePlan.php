<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CarePlan extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'care_plans';

    protected $appends = [
        'photo',
    ];

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
        'is_online',
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function carePlanMaintenanceSuscriptions()
    {
        return $this->hasMany(MaintenanceSuscription::class, 'care_plan_id', 'id');
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

    public function checkpoints()
    {
        return $this->belongsToMany(Checkpoint::class);
    }
}
