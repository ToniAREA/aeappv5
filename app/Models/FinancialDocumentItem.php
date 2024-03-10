<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialDocumentItem extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'financial_document_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'financial_document_id',
        'product_id',
        'description',
        'quantity',
        'unit_price',
        'line_position',
        'subtotal',
        'total_amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function itemFinantialDocumentTaxes()
    {
        return $this->hasMany(FinantialDocumentTax::class, 'item_id', 'id');
    }

    public function itemFinantialDocumentDiscounts()
    {
        return $this->hasMany(FinantialDocumentDiscount::class, 'item_id', 'id');
    }

    public function financial_document()
    {
        return $this->belongsTo(FinalcialDocument::class, 'financial_document_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
