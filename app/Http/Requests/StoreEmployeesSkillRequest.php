<?php

namespace App\Http\Requests;

use App\Models\EmployeesSkill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmployeesSkillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employees_skill_create');
    }

    public function rules()
    {
        return [
            'level' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
