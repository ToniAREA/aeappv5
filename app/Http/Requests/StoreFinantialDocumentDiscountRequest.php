<?php

namespace App\Http\Requests;

use App\Models\FinantialDocumentDiscount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFinantialDocumentDiscountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('finantial_document_discount_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'nullable',
            ],
            'discount_rate' => [
                'numeric',
            ],
        ];
    }
}
