<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEmployeeHolidayRequest;
use App\Http\Requests\StoreEmployeeHolidayRequest;
use App\Http\Requests\UpdateEmployeeHolidayRequest;
use App\Models\Employee;
use App\Models\EmployeeHoliday;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeHolidaysController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('employee_holiday_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeHolidays = EmployeeHoliday::with(['employee'])->get();

        return view('admin.employeeHolidays.index', compact('employeeHolidays'));
    }

    public function create()
    {
        abort_if(Gate::denies('employee_holiday_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employeeHolidays.create', compact('employees'));
    }

    public function store(StoreEmployeeHolidayRequest $request)
    {
        $employeeHoliday = EmployeeHoliday::create($request->all());

        return redirect()->route('admin.employee-holidays.index');
    }

    public function edit(EmployeeHoliday $employeeHoliday)
    {
        abort_if(Gate::denies('employee_holiday_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employeeHoliday->load('employee');

        return view('admin.employeeHolidays.edit', compact('employeeHoliday', 'employees'));
    }

    public function update(UpdateEmployeeHolidayRequest $request, EmployeeHoliday $employeeHoliday)
    {
        $employeeHoliday->update($request->all());

        return redirect()->route('admin.employee-holidays.index');
    }

    public function show(EmployeeHoliday $employeeHoliday)
    {
        abort_if(Gate::denies('employee_holiday_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeHoliday->load('employee');

        return view('admin.employeeHolidays.show', compact('employeeHoliday'));
    }

    public function destroy(EmployeeHoliday $employeeHoliday)
    {
        abort_if(Gate::denies('employee_holiday_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeHoliday->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeHolidayRequest $request)
    {
        $employeeHolidays = EmployeeHoliday::find(request('ids'));

        foreach ($employeeHolidays as $employeeHoliday) {
            $employeeHoliday->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
