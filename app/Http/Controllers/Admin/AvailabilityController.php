<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAvailabilityRequest;
use App\Http\Requests\StoreAvailabilityRequest;
use App\Http\Requests\UpdateAvailabilityRequest;
use App\Models\Availability;
use App\Models\Employee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AvailabilityController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('availability_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Availability::with(['employee'])->select(sprintf('%s.*', (new Availability)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'availability_show';
                $editGate      = 'availability_edit';
                $deleteGate    = 'availability_delete';
                $crudRoutePart = 'availabilities';

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

            $table->editColumn('employee.category', function ($row) {
                return $row->employee ? (is_string($row->employee) ? $row->employee : $row->employee->category) : '';
            });

            $table->editColumn('rate_multiplier', function ($row) {
                return $row->rate_multiplier ? $row->rate_multiplier : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Availability::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'employee']);

            return $table->make(true);
        }

        $employees = Employee::get();

        return view('admin.availabilities.index', compact('employees'));
    }

    public function create()
    {
        abort_if(Gate::denies('availability_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.availabilities.create', compact('employees'));
    }

    public function store(StoreAvailabilityRequest $request)
    {
        $availability = Availability::create($request->all());

        return redirect()->route('admin.availabilities.index');
    }

    public function edit(Availability $availability)
    {
        abort_if(Gate::denies('availability_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $availability->load('employee');

        return view('admin.availabilities.edit', compact('availability', 'employees'));
    }

    public function update(UpdateAvailabilityRequest $request, Availability $availability)
    {
        $availability->update($request->all());

        return redirect()->route('admin.availabilities.index');
    }

    public function show(Availability $availability)
    {
        abort_if(Gate::denies('availability_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $availability->load('employee');

        return view('admin.availabilities.show', compact('availability'));
    }

    public function destroy(Availability $availability)
    {
        abort_if(Gate::denies('availability_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $availability->delete();

        return back();
    }

    public function massDestroy(MassDestroyAvailabilityRequest $request)
    {
        $availabilities = Availability::find(request('ids'));

        foreach ($availabilities as $availability) {
            $availability->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
