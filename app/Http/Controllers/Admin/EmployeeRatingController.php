<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEmployeeRatingRequest;
use App\Http\Requests\StoreEmployeeRatingRequest;
use App\Http\Requests\UpdateEmployeeRatingRequest;
use App\Models\Client;
use App\Models\Employee;
use App\Models\EmployeeRating;
use App\Models\User;
use App\Models\Wlist;
use App\Models\Wlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeRatingController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('employee_rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeRatings = EmployeeRating::with(['employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog'])->get();

        return view('admin.employeeRatings.index', compact('employeeRatings'));
    }

    public function create()
    {
        abort_if(Gate::denies('employee_rating_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlists = Wlist::pluck('boat_namecomplete', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlogs = Wlog::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employeeRatings.create', compact('employees', 'for_wlists', 'for_wlogs', 'from_clients', 'from_users'));
    }

    public function store(StoreEmployeeRatingRequest $request)
    {
        $employeeRating = EmployeeRating::create($request->all());

        return redirect()->route('admin.employee-ratings.index');
    }

    public function edit(EmployeeRating $employeeRating)
    {
        abort_if(Gate::denies('employee_rating_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlists = Wlist::pluck('boat_namecomplete', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlogs = Wlog::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employeeRating->load('employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog');

        return view('admin.employeeRatings.edit', compact('employeeRating', 'employees', 'for_wlists', 'for_wlogs', 'from_clients', 'from_users'));
    }

    public function update(UpdateEmployeeRatingRequest $request, EmployeeRating $employeeRating)
    {
        $employeeRating->update($request->all());

        return redirect()->route('admin.employee-ratings.index');
    }

    public function show(EmployeeRating $employeeRating)
    {
        abort_if(Gate::denies('employee_rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeRating->load('employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog');

        return view('admin.employeeRatings.show', compact('employeeRating'));
    }

    public function destroy(EmployeeRating $employeeRating)
    {
        abort_if(Gate::denies('employee_rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeeRating->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeRatingRequest $request)
    {
        $employeeRatings = EmployeeRating::find(request('ids'));

        foreach ($employeeRatings as $employeeRating) {
            $employeeRating->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
