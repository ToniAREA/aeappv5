<?php

namespace App\Http\Requests;

use App\Models\Checkpoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCheckpointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('checkpoint_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'groups.*' => [
                'integer',
            ],
            'groups' => [
                'required',
                'array',
            ],
        ];
    }
}
