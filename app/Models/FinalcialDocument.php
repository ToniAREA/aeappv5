<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinalcialDocument extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'finalcial_documents';

    protected $dates = [
        'issue_date',
        'due_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_RADIO = [
        'pending'        => 'Pending',
        'paid'           => 'Paid',
        'partially_paid' => 'Partially paid',
        'cancelled'      => 'Cancelled',
    ];

    public const DOC_TYPE_RADIO = [
        'estimate'    => 'Estimate',
        'proforma'    => 'Proforma',
        'invoice'     => 'Invoice',
        'credit_note' => 'Credit Note',
    ];

    protected $fillable = [
        'doc_type',
        'reference_number',
        'status',
        'client_id',
        'issue_date',
        'due_date',
        'currency_id',
        'subtotal',
        'total_taxes',
        'total_discounts',
        'total_amount',
        'payment_terms',
        'security_code',
        'notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function financialDocumentFinancialDocumentItems()
    {
        return $this->hasMany(FinancialDocumentItem::class, 'financial_document_id', 'id');
    }

    public function financialDocumentPayments()
    {
        return $this->hasMany(Payment::class, 'financial_document_id', 'id');
    }

    public function financialDocumentAssetsRentals()
    {
        return $this->hasMany(AssetsRental::class, 'financial_document_id', 'id');
    }

    public function financialDocumentWlists()
    {
        return $this->hasMany(Wlist::class, 'financial_document_id', 'id');
    }

    public function financialDocumentWlogs()
    {
        return $this->hasMany(Wlog::class, 'financial_document_id', 'id');
    }

    public function financialDocumentMlogs()
    {
        return $this->hasMany(Mlog::class, 'financial_document_id', 'id');
    }

    public function financialDocumentBookingLists()
    {
        return $this->hasMany(BookingList::class, 'financial_document_id', 'id');
    }

    public function financialDocumentSuscriptions()
    {
        return $this->hasMany(Suscription::class, 'financial_document_id', 'id');
    }

    public function financialDocumentMaintenanceSuscriptions()
    {
        return $this->hasMany(MaintenanceSuscription::class, 'financial_document_id', 'id');
    }

    public function financialDocumentIotSuscriptions()
    {
        return $this->hasMany(IotSuscription::class, 'financial_document_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function getIssueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setIssueDateAttribute($value)
    {
        $this->attributes['issue_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
