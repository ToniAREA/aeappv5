<?php

namespace App\Http\Requests;

use App\Models\CheckpointsGroup;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCheckpointsGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('checkpoints_group_edit');
    }

    public function rules()
    {
        return [
            'group' => [
                'string',
                'required',
                'unique:checkpoints_groups,group,' . request()->route('checkpoints_group')->id,
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
