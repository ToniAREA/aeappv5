<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeAttendanceRequest;
use App\Http\Requests\UpdateEmployeeAttendanceRequest;
use App\Http\Resources\Admin\EmployeeAttendanceResource;
use App\Models\EmployeeAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeAttendancesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employee_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeAttendanceResource(EmployeeAttendance::with(['employee'])->get());
    }

    public function store(StoreEmployeeAttendanceRequest $request)
    {
        $employeeAttendance = EmployeeAttendance::create($request->all());

        return (new EmployeeAttendanceResource($employeeAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmployeeAttendance $employeeAttendance)
    {
        abort_if(Gate::denies('employee_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmployeeAttendanceResource($employeeAttendance->load(['employee']));
    }

    public function update(UpdateEmployeeAttendanceRequest $request, EmployeeAttendance $employeeAttendance)
    {
        $employeeAttendance->update($request->all());

        return (new EmployeeAttendanceResource($employeeAttendance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmployeeAttendance $employeeAttendance)
    {
        abort_if(Gate::denies('employee_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeAttendance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
