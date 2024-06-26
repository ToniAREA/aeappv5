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

class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'products';

    protected $appends = [
        'photos',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'ref_provider',
        'model',
        'short_desc',
        'description',
    ];

    protected $fillable = [
        'is_online',
        'brand_id',
        'ref_manu',
        'ref_provider',
        'model',
        'name',
        'short_desc',
        'description',
        'product_price',
        'purchase_discount',
        'purchase_price',
        'has_stock',
        'stock',
        'local_stock',
        'product_location_id',
        'link_a',
        'link_a_description',
        'link_b',
        'link_b_description',
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

    public function productMlogs()
    {
        return $this->hasMany(Mlog::class, 'product_id', 'id');
    }

    public function productTechnicalDocumentations()
    {
        return $this->hasMany(TechnicalDocumentation::class, 'product_id', 'id');
    }

    public function productIotDevices()
    {
        return $this->hasMany(IotDevice::class, 'product_id', 'id');
    }

    public function productFinancialDocumentItems()
    {
        return $this->hasMany(FinancialDocumentItem::class, 'product_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class);
    }

    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function product_location()
    {
        return $this->belongsTo(AssetLocation::class, 'product_location_id');
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class);
    }
}
