<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookingStatusRequest;
use App\Http\Requests\StoreBookingStatusRequest;
use App\Http\Requests\UpdateBookingStatusRequest;
use App\Models\BookingStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingStatusesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('booking_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingStatuses = BookingStatus::all();

        return view('admin.bookingStatuses.index', compact('bookingStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('booking_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookingStatuses.create');
    }

    public function store(StoreBookingStatusRequest $request)
    {
        $bookingStatus = BookingStatus::create($request->all());

        return redirect()->route('admin.booking-statuses.index');
    }

    public function edit(BookingStatus $bookingStatus)
    {
        abort_if(Gate::denies('booking_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookingStatuses.edit', compact('bookingStatus'));
    }

    public function update(UpdateBookingStatusRequest $request, BookingStatus $bookingStatus)
    {
        $bookingStatus->update($request->all());

        return redirect()->route('admin.booking-statuses.index');
    }

    public function show(BookingStatus $bookingStatus)
    {
        abort_if(Gate::denies('booking_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookingStatuses.show', compact('bookingStatus'));
    }

    public function destroy(BookingStatus $bookingStatus)
    {
        abort_if(Gate::denies('booking_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookingStatusRequest $request)
    {
        $bookingStatuses = BookingStatus::find(request('ids'));

        foreach ($bookingStatuses as $bookingStatus) {
            $bookingStatus->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
