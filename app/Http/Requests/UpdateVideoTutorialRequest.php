<?php

namespace App\Http\Requests;

use App\Models\VideoTutorial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVideoTutorialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('video_tutorial_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'video_url' => [
                'string',
                'nullable',
            ],
            'subjects.*' => [
                'integer',
            ],
            'subjects' => [
                'array',
            ],
        ];
    }
}
