<?php

namespace App\Http\Requests;

use App\Models\FinantialDocumentDiscount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFinantialDocumentDiscountRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('finantial_document_discount_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:finantial_document_discounts,id',
        ];
    }
}
