<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingSlotRequest;
use App\Http\Requests\UpdateBookingSlotRequest;
use App\Http\Resources\Admin\BookingSlotResource;
use App\Models\BookingSlot;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingSlotsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('booking_slot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookingSlotResource(BookingSlot::with(['employee', 'status'])->get());
    }

    public function store(StoreBookingSlotRequest $request)
    {
        $bookingSlot = BookingSlot::create($request->all());

        return (new BookingSlotResource($bookingSlot))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BookingSlot $bookingSlot)
    {
        abort_if(Gate::denies('booking_slot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookingSlotResource($bookingSlot->load(['employee', 'status']));
    }

    public function update(UpdateBookingSlotRequest $request, BookingSlot $bookingSlot)
    {
        $bookingSlot->update($request->all());

        return (new BookingSlotResource($bookingSlot))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BookingSlot $bookingSlot)
    {
        abort_if(Gate::denies('booking_slot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingSlot->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
