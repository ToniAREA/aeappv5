<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBookingListRequest;
use App\Http\Requests\StoreBookingListRequest;
use App\Http\Requests\UpdateBookingListRequest;
use App\Models\Boat;
use App\Models\BookingList;
use App\Models\Client;
use App\Models\Employee;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BookingListController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('booking_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BookingList::with(['user', 'client', 'boat', 'employee'])->select(sprintf('%s.*', (new BookingList)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'booking_list_show';
                $editGate      = 'booking_list_edit';
                $deleteGate    = 'booking_list_delete';
                $crudRoutePart = 'booking-lists';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.lastname', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->lastname) : '';
            });
            $table->addColumn('boat_name', function ($row) {
                return $row->boat ? $row->boat->name : '';
            });

            $table->editColumn('boat.boat_type', function ($row) {
                return $row->boat ? (is_string($row->boat) ? $row->boat : $row->boat->boat_type) : '';
            });
            $table->addColumn('employee_id_employee', function ($row) {
                return $row->employee ? $row->employee->id_employee : '';
            });

            $table->editColumn('employee.category', function ($row) {
                return $row->employee ? (is_string($row->employee) ? $row->employee : $row->employee->category) : '';
            });

            $table->editColumn('hours', function ($row) {
                return $row->hours ? $row->hours : '';
            });
            $table->editColumn('start_time', function ($row) {
                return $row->start_time ? $row->start_time : '';
            });
            $table->editColumn('end_time', function ($row) {
                return $row->end_time ? $row->end_time : '';
            });
            $table->editColumn('hour_rate', function ($row) {
                return $row->hour_rate ? $row->hour_rate : '';
            });
            $table->editColumn('total_price', function ($row) {
                return $row->total_price ? $row->total_price : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });
            $table->editColumn('confirmed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->confirmed ? 'checked' : null) . '>';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'client', 'boat', 'employee', 'confirmed']);

            return $table->make(true);
        }

        $users     = User::get();
        $clients   = Client::get();
        $boats     = Boat::get();
        $employees = Employee::get();

        return view('admin.bookingLists.index', compact('users', 'clients', 'boats', 'employees'));
    }

    public function create()
    {
        abort_if(Gate::denies('booking_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookingLists.create', compact('boats', 'clients', 'employees', 'users'));
    }

    public function store(StoreBookingListRequest $request)
    {
        $bookingList = BookingList::create($request->all());

        return redirect()->route('admin.booking-lists.index');
    }

    public function edit(BookingList $bookingList)
    {
        abort_if(Gate::denies('booking_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookingList->load('user', 'client', 'boat', 'employee');

        return view('admin.bookingLists.edit', compact('boats', 'bookingList', 'clients', 'employees', 'users'));
    }

    public function update(UpdateBookingListRequest $request, BookingList $bookingList)
    {
        $bookingList->update($request->all());

        return redirect()->route('admin.booking-lists.index');
    }

    public function show(BookingList $bookingList)
    {
        abort_if(Gate::denies('booking_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingList->load('user', 'client', 'boat', 'employee');

        return view('admin.bookingLists.show', compact('bookingList'));
    }

    public function destroy(BookingList $bookingList)
    {
        abort_if(Gate::denies('booking_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingList->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookingListRequest $request)
    {
        $bookingLists = BookingList::find(request('ids'));

        foreach ($bookingLists as $bookingList) {
            $bookingList->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
