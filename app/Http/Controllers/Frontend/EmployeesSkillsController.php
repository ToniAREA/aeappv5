<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmployeesSkillRequest;
use App\Http\Requests\StoreEmployeesSkillRequest;
use App\Http\Requests\UpdateEmployeesSkillRequest;
use App\Models\Employee;
use App\Models\EmployeesSkill;
use App\Models\SkillsCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeesSkillsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employees_skill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeesSkills = EmployeesSkill::with(['employee', 'subject'])->get();

        return view('frontend.employeesSkills.index', compact('employeesSkills'));
    }

    public function create()
    {
        abort_if(Gate::denies('employees_skill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = SkillsCategory::pluck('subject', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.employeesSkills.create', compact('employees', 'subjects'));
    }

    public function store(StoreEmployeesSkillRequest $request)
    {
        $employeesSkill = EmployeesSkill::create($request->all());

        return redirect()->route('frontend.employees-skills.index');
    }

    public function edit(EmployeesSkill $employeesSkill)
    {
        abort_if(Gate::denies('employees_skill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = SkillsCategory::pluck('subject', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employeesSkill->load('employee', 'subject');

        return view('frontend.employeesSkills.edit', compact('employees', 'employeesSkill', 'subjects'));
    }

    public function update(UpdateEmployeesSkillRequest $request, EmployeesSkill $employeesSkill)
    {
        $employeesSkill->update($request->all());

        return redirect()->route('frontend.employees-skills.index');
    }

    public function show(EmployeesSkill $employeesSkill)
    {
        abort_if(Gate::denies('employees_skill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeesSkill->load('employee', 'subject');

        return view('frontend.employeesSkills.show', compact('employeesSkill'));
    }

    public function destroy(EmployeesSkill $employeesSkill)
    {
        abort_if(Gate::denies('employees_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeesSkill->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeesSkillRequest $request)
    {
        $employeesSkills = EmployeesSkill::find(request('ids'));

        foreach ($employeesSkills as $employeesSkill) {
            $employeesSkill->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
