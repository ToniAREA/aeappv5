<?php

namespace App\Http\Requests;

use App\Models\EmployeesSkill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEmployeesSkillRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('employees_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:employees_skills,id',
        ];
    }
}
