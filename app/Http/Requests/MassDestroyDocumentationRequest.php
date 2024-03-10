<?php

namespace App\Http\Requests;

use App\Models\Documentation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDocumentationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('documentation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:documentations,id',
        ];
    }
}
