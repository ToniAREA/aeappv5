<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Marina;
use App\Models\Role;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::with(['client', 'boat', 'wlists', 'for_roles', 'for_employees', 'in_marina'])->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id');

        $for_roles = Role::pluck('title', 'id');

        $for_employees = Employee::pluck('id_employee', 'id');

        $in_marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointments.create', compact('boats', 'clients', 'for_employees', 'for_roles', 'in_marinas', 'wlists'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());
        $appointment->wlists()->sync($request->input('wlists', []));
        $appointment->for_roles()->sync($request->input('for_roles', []));
        $appointment->for_employees()->sync($request->input('for_employees', []));

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id');

        $for_roles = Role::pluck('title', 'id');

        $for_employees = Employee::pluck('id_employee', 'id');

        $in_marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('client', 'boat', 'wlists', 'for_roles', 'for_employees', 'in_marina');

        return view('admin.appointments.edit', compact('appointment', 'boats', 'clients', 'for_employees', 'for_roles', 'in_marinas', 'wlists'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());
        $appointment->wlists()->sync($request->input('wlists', []));
        $appointment->for_roles()->sync($request->input('for_roles', []));
        $appointment->for_employees()->sync($request->input('for_employees', []));

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('client', 'boat', 'wlists', 'for_roles', 'for_employees', 'in_marina');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        $appointments = Appointment::find(request('ids'));

        foreach ($appointments as $appointment) {
            $appointment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
