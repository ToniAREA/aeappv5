<?php

namespace App\Http\Requests;

use App\Models\FinancialDocumentItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFinancialDocumentItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('financial_document_item_create');
    }

    public function rules()
    {
        return [
            'description' => [
                'string',
                'nullable',
            ],
            'quantity' => [
                'numeric',
            ],
            'line_position' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
