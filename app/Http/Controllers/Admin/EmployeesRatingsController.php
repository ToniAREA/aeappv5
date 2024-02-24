<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmployeesRatingRequest;
use App\Http\Requests\StoreEmployeesRatingRequest;
use App\Http\Requests\UpdateEmployeesRatingRequest;
use App\Models\Client;
use App\Models\Employee;
use App\Models\EmployeesRating;
use App\Models\User;
use App\Models\Wlist;
use App\Models\Wlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeesRatingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('employees_rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeesRatings = EmployeesRating::with(['employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog'])->get();

        return view('admin.employeesRatings.index', compact('employeesRatings'));
    }

    public function create()
    {
        abort_if(Gate::denies('employees_rating_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlists = Wlist::pluck('boat_namecomplete', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlogs = Wlog::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.employeesRatings.create', compact('employees', 'for_wlists', 'for_wlogs', 'from_clients', 'from_users'));
    }

    public function store(StoreEmployeesRatingRequest $request)
    {
        $employeesRating = EmployeesRating::create($request->all());

        return redirect()->route('admin.employees-ratings.index');
    }

    public function edit(EmployeesRating $employeesRating)
    {
        abort_if(Gate::denies('employees_rating_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $from_clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlists = Wlist::pluck('boat_namecomplete', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_wlogs = Wlog::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employeesRating->load('employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog');

        return view('admin.employeesRatings.edit', compact('employees', 'employeesRating', 'for_wlists', 'for_wlogs', 'from_clients', 'from_users'));
    }

    public function update(UpdateEmployeesRatingRequest $request, EmployeesRating $employeesRating)
    {
        $employeesRating->update($request->all());

        return redirect()->route('admin.employees-ratings.index');
    }

    public function show(EmployeesRating $employeesRating)
    {
        abort_if(Gate::denies('employees_rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeesRating->load('employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog');

        return view('admin.employeesRatings.show', compact('employeesRating'));
    }

    public function destroy(EmployeesRating $employeesRating)
    {
        abort_if(Gate::denies('employees_rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employeesRating->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeesRatingRequest $request)
    {
        $employeesRatings = EmployeesRating::find(request('ids'));

        foreach ($employeesRatings as $employeesRating) {
            $employeesRating->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
