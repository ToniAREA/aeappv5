<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEmployeeAttendanceRequest;
use App\Http\Requests\StoreEmployeeAttendanceRequest;
use App\Http\Requests\UpdateEmployeeAttendanceRequest;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeAttendancesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('employee_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeAttendances = EmployeeAttendance::with(['employee'])->get();

        return view('admin.employeeAttendances.index', compact('employeeAttendances'));
    }

    public function create()
    {
        abort_if(Gate::denies('employee_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employeeAttendances.create', compact('employees'));
    }

    public function store(StoreEmployeeAttendanceRequest $request)
    {
        $employeeAttendance = EmployeeAttendance::create($request->all());

        return redirect()->route('admin.employee-attendances.index');
    }

    public function edit(EmployeeAttendance $employeeAttendance)
    {
        abort_if(Gate::denies('employee_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employeeAttendance->load('employee');

        return view('admin.employeeAttendances.edit', compact('employeeAttendance', 'employees'));
    }

    public function update(UpdateEmployeeAttendanceRequest $request, EmployeeAttendance $employeeAttendance)
    {
        $employeeAttendance->update($request->all());

        return redirect()->route('admin.employee-attendances.index');
    }

    public function show(EmployeeAttendance $employeeAttendance)
    {
        abort_if(Gate::denies('employee_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeAttendance->load('employee');

        return view('admin.employeeAttendances.show', compact('employeeAttendance'));
    }

    public function destroy(EmployeeAttendance $employeeAttendance)
    {
        abort_if(Gate::denies('employee_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeAttendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeAttendanceRequest $request)
    {
        $employeeAttendances = EmployeeAttendance::find(request('ids'));

        foreach ($employeeAttendances as $employeeAttendance) {
            $employeeAttendance->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
