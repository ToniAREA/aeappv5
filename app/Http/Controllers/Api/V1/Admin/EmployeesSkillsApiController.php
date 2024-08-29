<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeesSkillRequest;
use App\Http\Requests\UpdateEmployeesSkillRequest;
use App\Http\Resources\Admin\EmployeesSkillResource;
use App\Models\EmployeesSkill;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeesSkillsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employees_skill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeesSkillResource(EmployeesSkill::with(['employee', 'subject'])->get());
    }

    public function store(StoreEmployeesSkillRequest $request)
    {
        $employeesSkill = EmployeesSkill::create($request->all());

        return (new EmployeesSkillResource($employeesSkill))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmployeesSkill $employeesSkill)
    {
        abort_if(Gate::denies('employees_skill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeesSkillResource($employeesSkill->load(['employee', 'subject']));
    }

    public function update(UpdateEmployeesSkillRequest $request, EmployeesSkill $employeesSkill)
    {
        $employeesSkill->update($request->all());

        return (new EmployeesSkillResource($employeesSkill))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmployeesSkill $employeesSkill)
    {
        abort_if(Gate::denies('employees_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeesSkill->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
