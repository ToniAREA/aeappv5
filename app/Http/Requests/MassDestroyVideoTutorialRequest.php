<?php

namespace App\Http\Requests;

use App\Models\VideoTutorial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVideoTutorialRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('video_tutorial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:video_tutorials,id',
        ];
    }
}
