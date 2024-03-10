<?php

namespace App\Http\Requests;

use App\Models\FinantialDocumentDiscount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFinantialDocumentDiscountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('finantial_document_discount_edit');
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
