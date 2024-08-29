<?php

namespace App\Http\Requests;

use App\Models\FinancialDocumentItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFinancialDocumentItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('financial_document_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:financial_document_items,id',
        ];
    }
}
