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
use Yajra\DataTables\Facades\DataTables;

class EmployeeHolidaysController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('employee_holiday_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EmployeeHoliday::with(['employee'])->select(sprintf('%s.*', (new EmployeeHoliday)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'employee_holiday_show';
                $editGate      = 'employee_holiday_edit';
                $deleteGate    = 'employee_holiday_delete';
                $crudRoutePart = 'employee-holidays';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('employee_id_employee', function ($row) {
                return $row->employee ? $row->employee->id_employee : '';
            });

            $table->editColumn('employee.namecomplete', function ($row) {
                return $row->employee ? (is_string($row->employee) ? $row->employee : $row->employee->namecomplete) : '';
            });

            $table->editColumn('days_taken', function ($row) {
                return $row->days_taken ? $row->days_taken : '';
            });
            $table->editColumn('is_completed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_completed ? 'checked' : null) . '>';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internalnotes', function ($row) {
                return $row->internalnotes ? $row->internalnotes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'employee', 'is_completed']);

            return $table->make(true);
        }

        return view('admin.employeeHolidays.index');
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
