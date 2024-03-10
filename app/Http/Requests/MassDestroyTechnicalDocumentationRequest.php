<?php

namespace App\Http\Requests;

use App\Models\TechnicalDocumentation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTechnicalDocumentationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('technical_documentation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:technical_documentations,id',
        ];
    }
}
