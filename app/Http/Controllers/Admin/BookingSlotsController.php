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

class BookingSlotsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('booking_slot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingSlots = BookingSlot::with(['employee', 'status'])->get();

        $employees = Employee::get();

        $booking_statuses = BookingStatus::get();

        return view('admin.bookingSlots.index', compact('bookingSlots', 'booking_statuses', 'employees'));
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
