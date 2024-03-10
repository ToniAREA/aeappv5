<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingListRequest;
use App\Http\Requests\UpdateBookingListRequest;
use App\Http\Resources\Admin\BookingListResource;
use App\Models\BookingList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingListApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('booking_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookingListResource(BookingList::with(['user', 'client', 'boat', 'employee', 'booking_slot', 'financial_document'])->get());
    }

    public function store(StoreBookingListRequest $request)
    {
        $bookingList = BookingList::create($request->all());

        return (new BookingListResource($bookingList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BookingList $bookingList)
    {
        abort_if(Gate::denies('booking_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookingListResource($bookingList->load(['user', 'client', 'boat', 'employee', 'booking_slot', 'financial_document']));
    }

    public function update(UpdateBookingListRequest $request, BookingList $bookingList)
    {
        $bookingList->update($request->all());

        return (new BookingListResource($bookingList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BookingList $bookingList)
    {
        abort_if(Gate::denies('booking_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
