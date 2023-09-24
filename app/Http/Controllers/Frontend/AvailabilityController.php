<?php

namespace App\Http\Controllers\Frontend;

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

class AvailabilityController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('availability_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $availabilities = Availability::with(['employee'])->get();

        $employees = Employee::get();

        return view('frontend.availabilities.index', compact('availabilities', 'employees'));
    }

    public function create()
    {
        abort_if(Gate::denies('availability_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.availabilities.create', compact('employees'));
    }

    public function store(StoreAvailabilityRequest $request)
    {
        $availability = Availability::create($request->all());

        return redirect()->route('frontend.availabilities.index');
    }

    public function edit(Availability $availability)
    {
        abort_if(Gate::denies('availability_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $availability->load('employee');

        return view('frontend.availabilities.edit', compact('availability', 'employees'));
    }

    public function update(UpdateAvailabilityRequest $request, Availability $availability)
    {
        $availability->update($request->all());

        return redirect()->route('frontend.availabilities.index');
    }

    public function show(Availability $availability)
    {
        abort_if(Gate::denies('availability_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $availability->load('employee');

        return view('frontend.availabilities.show', compact('availability'));
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
