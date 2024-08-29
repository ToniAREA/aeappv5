<?php

namespace App\Http\Requests;

use App\Models\FinantialDocumentTax;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFinantialDocumentTaxRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('finantial_document_tax_edit');
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
