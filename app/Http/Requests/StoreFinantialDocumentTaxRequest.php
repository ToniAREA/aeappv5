<?php

namespace App\Http\Requests;

use App\Models\FinantialDocumentTax;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFinantialDocumentTaxRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('finantial_document_tax_create');
    }

    public function rules()
    {
        return [
            'tax_type' => [
                'required',
            ],
            'tax_rate' => [
                'numeric',
            ],
        ];
    }
}
