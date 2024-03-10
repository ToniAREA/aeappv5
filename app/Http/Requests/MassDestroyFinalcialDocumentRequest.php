<?php

namespace App\Http\Requests;

use App\Models\FinalcialDocument;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFinalcialDocumentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('finalcial_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:finalcial_documents,id',
        ];
    }
}
