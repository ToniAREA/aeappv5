<?php

namespace App\Http\Requests;

use App\Models\VideoCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVideoCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('video_category_edit');
    }

    public function rules()
    {
        return [
            'subject' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
