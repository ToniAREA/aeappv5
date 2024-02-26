<?php

namespace App\Http\Requests;

use App\Models\DocumentationCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDocumentationCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('documentation_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:documentation_categories,id',
        ];
    }
}
