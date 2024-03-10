<?php

namespace App\Http\Requests;

use App\Models\Checkpoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCheckpointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('checkpoint_create');
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
