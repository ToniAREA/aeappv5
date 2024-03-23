<?php

namespace App\Http\Requests;

use App\Models\EmployeeSkill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEmployeeSkillRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('employee_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:employee_skills,id',
        ];
    }
}
