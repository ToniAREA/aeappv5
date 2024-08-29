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

class Plan extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'plans';

    protected $appends = [
        'photo',
        'contract',
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
    ];

    protected $fillable = [
        'is_online',
        'plan_name',
        'short_description',
        'description',
        'period',
        'period_price',
        'hourly_rate',
        'hourly_rate_discount',
        'material_discount',
        'link',
        'link_description',
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

    public function planSuscriptions()
    {
        return $this->hasMany(Suscription::class, 'plan_id', 'id');
    }

    public function planWaitingLists()
    {
        return $this->hasMany(WaitingList::class, 'plan_id', 'id');
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

    public function getContractAttribute()
    {
        return $this->getMedia('contract')->last();
    }
}
