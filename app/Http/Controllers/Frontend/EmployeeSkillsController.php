<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEmployeeSkillRequest;
use App\Http\Requests\StoreEmployeeSkillRequest;
use App\Http\Requests\UpdateEmployeeSkillRequest;
use App\Models\Employee;
use App\Models\EmployeeSkill;
use App\Models\SkillsCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeSkillsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('employee_skill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeSkills = EmployeeSkill::with(['employee', 'subject'])->get();

        return view('frontend.employeeSkills.index', compact('employeeSkills'));
    }

    public function create()
    {
        abort_if(Gate::denies('employee_skill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = SkillsCategory::pluck('subject', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.employeeSkills.create', compact('employees', 'subjects'));
    }

    public function store(StoreEmployeeSkillRequest $request)
    {
        $employeeSkill = EmployeeSkill::create($request->all());

        return redirect()->route('frontend.employee-skills.index');
    }

    public function edit(EmployeeSkill $employeeSkill)
    {
        abort_if(Gate::denies('employee_skill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = SkillsCategory::pluck('subject', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employeeSkill->load('employee', 'subject');

        return view('frontend.employeeSkills.edit', compact('employeeSkill', 'employees', 'subjects'));
    }

    public function update(UpdateEmployeeSkillRequest $request, EmployeeSkill $employeeSkill)
    {
        $employeeSkill->update($request->all());

        return redirect()->route('frontend.employee-skills.index');
    }

    public function show(EmployeeSkill $employeeSkill)
    {
        abort_if(Gate::denies('employee_skill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeSkill->load('employee', 'subject');

        return view('frontend.employeeSkills.show', compact('employeeSkill'));
    }

    public function destroy(EmployeeSkill $employeeSkill)
    {
        abort_if(Gate::denies('employee_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeSkill->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeSkillRequest $request)
    {
        $employeeSkills = EmployeeSkill::find(request('ids'));

        foreach ($employeeSkills as $employeeSkill) {
            $employeeSkill->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
