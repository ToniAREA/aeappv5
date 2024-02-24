<?php

namespace App\Http\Requests;

use App\Models\VideoCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVideoCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('video_category_create');
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
