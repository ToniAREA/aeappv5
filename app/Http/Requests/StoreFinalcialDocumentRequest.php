<?php

namespace App\Http\Requests;

use App\Models\FinalcialDocument;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFinalcialDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('finalcial_document_create');
    }

    public function rules()
    {
        return [
            'reference_number' => [
                'string',
                'nullable',
            ],
            'issue_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'due_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'payment_terms' => [
                'string',
                'nullable',
            ],
            'security_code' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
