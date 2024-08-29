<?php

namespace App\Http\Requests;

use App\Models\CheckpointsGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCheckpointsGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('checkpoints_group_create');
    }

    public function rules()
    {
        return [
            'group' => [
                'string',
                'required',
                'unique:checkpoints_groups',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
