<?php

namespace App\Http\Requests;

use App\Models\TechDocsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTechDocsTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tech_docs_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tech_docs_types,id',
        ];
    }
}
