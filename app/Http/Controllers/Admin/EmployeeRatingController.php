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
use Yajra\DataTables\Facades\DataTables;

class EmployeeRatingController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('employee_rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EmployeeRating::with(['employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog'])->select(sprintf('%s.*', (new EmployeeRating)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'employee_rating_show';
                $editGate      = 'employee_rating_edit';
                $deleteGate    = 'employee_rating_delete';
                $crudRoutePart = 'employee-ratings';

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
            $table->addColumn('from_user_name', function ($row) {
                return $row->from_user ? $row->from_user->name : '';
            });

            $table->editColumn('from_user.email', function ($row) {
                return $row->from_user ? (is_string($row->from_user) ? $row->from_user : $row->from_user->email) : '';
            });
            $table->addColumn('from_client_name', function ($row) {
                return $row->from_client ? $row->from_client->name : '';
            });

            $table->editColumn('from_client.lastname', function ($row) {
                return $row->from_client ? (is_string($row->from_client) ? $row->from_client : $row->from_client->lastname) : '';
            });
            $table->addColumn('for_wlist_boat_namecomplete', function ($row) {
                return $row->for_wlist ? $row->for_wlist->boat_namecomplete : '';
            });

            $table->editColumn('for_wlist.description', function ($row) {
                return $row->for_wlist ? (is_string($row->for_wlist) ? $row->for_wlist : $row->for_wlist->description) : '';
            });
            $table->addColumn('for_wlog_date', function ($row) {
                return $row->for_wlog ? $row->for_wlog->date : '';
            });

            $table->editColumn('for_wlog.boat_namecomplete', function ($row) {
                return $row->for_wlog ? (is_string($row->for_wlog) ? $row->for_wlog : $row->for_wlog->boat_namecomplete) : '';
            });
            $table->editColumn('rating', function ($row) {
                return $row->rating ? $row->rating : '';
            });
            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : '';
            });
            $table->editColumn('show_online', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->show_online ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'employee', 'from_user', 'from_client', 'for_wlist', 'for_wlog', 'show_online']);

            return $table->make(true);
        }

        return view('admin.employeeRatings.index');
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
