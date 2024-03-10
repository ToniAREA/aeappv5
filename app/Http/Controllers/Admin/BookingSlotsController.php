<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBookingSlotRequest;
use App\Http\Requests\StoreBookingSlotRequest;
use App\Http\Requests\UpdateBookingSlotRequest;
use App\Models\BookingSlot;
use App\Models\BookingStatus;
use App\Models\Employee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BookingSlotsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('booking_slot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BookingSlot::with(['employee', 'status'])->select(sprintf('%s.*', (new BookingSlot)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'booking_slot_show';
                $editGate      = 'booking_slot_edit';
                $deleteGate    = 'booking_slot_delete';
                $crudRoutePart = 'booking-slots';

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
            $table->editColumn('show_online', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->show_online ? 'checked' : null) . '>';
            });
            $table->editColumn('booked', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->booked ? 'checked' : null) . '>';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'employee', 'show_online', 'booked', 'status']);

            return $table->make(true);
        }

        $employees        = Employee::get();
        $booking_statuses = BookingStatus::get();

        return view('admin.bookingSlots.index', compact('employees', 'booking_statuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('booking_slot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = BookingStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookingSlots.create', compact('employees', 'statuses'));
    }

    public function store(StoreBookingSlotRequest $request)
    {
        $bookingSlot = BookingSlot::create($request->all());

        return redirect()->route('admin.booking-slots.index');
    }

    public function edit(BookingSlot $bookingSlot)
    {
        abort_if(Gate::denies('booking_slot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = BookingStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookingSlot->load('employee', 'status');

        return view('admin.bookingSlots.edit', compact('bookingSlot', 'employees', 'statuses'));
    }

    public function update(UpdateBookingSlotRequest $request, BookingSlot $bookingSlot)
    {
        $bookingSlot->update($request->all());

        return redirect()->route('admin.booking-slots.index');
    }

    public function show(BookingSlot $bookingSlot)
    {
        abort_if(Gate::denies('booking_slot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingSlot->load('employee', 'status', 'bookingSlotBookingLists');

        return view('admin.bookingSlots.show', compact('bookingSlot'));
    }

    public function destroy(BookingSlot $bookingSlot)
    {
        abort_if(Gate::denies('booking_slot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingSlot->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookingSlotRequest $request)
    {
        $bookingSlots = BookingSlot::find(request('ids'));

        foreach ($bookingSlots as $bookingSlot) {
            $bookingSlot->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
