<?php

namespace App\Http\Requests;

use App\Models\VideoCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVideoCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('video_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:video_categories,id',
        ];
    }
}
