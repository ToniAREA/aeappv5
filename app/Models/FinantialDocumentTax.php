<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinantialDocumentTax extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'finantial_document_taxes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'item_id',
        'tax_type',
        'tax_rate',
        'tax_amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TAX_TYPE_RADIO = [
        'general_vat'           => 'General VAT',
        'reduced_vat'           => 'Reduced VAT',
        'super-reduced_vat'     => 'Super-Reduced VAT',
        'equivalence_surcharge' => 'Equivalence Surcharge',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function item()
    {
        return $this->belongsTo(FinancialDocumentItem::class, 'item_id');
    }
}
