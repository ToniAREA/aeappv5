<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeSkillRequest;
use App\Http\Requests\UpdateEmployeeSkillRequest;
use App\Http\Resources\Admin\EmployeeSkillResource;
use App\Models\EmployeeSkill;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeSkillsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employee_skill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeSkillResource(EmployeeSkill::with(['employee', 'subject'])->get());
    }

    public function store(StoreEmployeeSkillRequest $request)
    {
        $employeeSkill = EmployeeSkill::create($request->all());

        return (new EmployeeSkillResource($employeeSkill))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmployeeSkill $employeeSkill)
    {
        abort_if(Gate::denies('employee_skill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeSkillResource($employeeSkill->load(['employee', 'subject']));
    }

    public function update(UpdateEmployeeSkillRequest $request, EmployeeSkill $employeeSkill)
    {
        $employeeSkill->update($request->all());

        return (new EmployeeSkillResource($employeeSkill))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmployeeSkill $employeeSkill)
    {
        abort_if(Gate::denies('employee_skill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeSkill->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
