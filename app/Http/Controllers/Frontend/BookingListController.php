<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBookingListRequest;
use App\Http\Requests\StoreBookingListRequest;
use App\Http\Requests\UpdateBookingListRequest;
use App\Models\Boat;
use App\Models\BookingList;
use App\Models\BookingSlot;
use App\Models\Client;
use App\Models\Employee;
use App\Models\FinalcialDocument;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingListController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('booking_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingLists = BookingList::with(['user', 'client', 'boat', 'employee', 'booking_slot', 'financial_document'])->get();

        $users = User::get();

        $clients = Client::get();

        $boats = Boat::get();

        $employees = Employee::get();

        $booking_slots = BookingSlot::get();

        $finalcial_documents = FinalcialDocument::get();

        return view('frontend.bookingLists.index', compact('boats', 'bookingLists', 'booking_slots', 'clients', 'employees', 'finalcial_documents', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('booking_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booking_slots = BookingSlot::pluck('star_time', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.bookingLists.create', compact('boats', 'booking_slots', 'clients', 'employees', 'financial_documents', 'users'));
    }

    public function store(StoreBookingListRequest $request)
    {
        $bookingList = BookingList::create($request->all());

        return redirect()->route('frontend.booking-lists.index');
    }

    public function edit(BookingList $bookingList)
    {
        abort_if(Gate::denies('booking_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = Employee::pluck('id_employee', 'id')->prepend(trans('global.pleaseSelect'), '');

        $booking_slots = BookingSlot::pluck('star_time', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookingList->load('user', 'client', 'boat', 'employee', 'booking_slot', 'financial_document');

        return view('frontend.bookingLists.edit', compact('boats', 'bookingList', 'booking_slots', 'clients', 'employees', 'financial_documents', 'users'));
    }

    public function update(UpdateBookingListRequest $request, BookingList $bookingList)
    {
        $bookingList->update($request->all());

        return redirect()->route('frontend.booking-lists.index');
    }

    public function show(BookingList $bookingList)
    {
        abort_if(Gate::denies('booking_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingList->load('user', 'client', 'boat', 'employee', 'booking_slot', 'financial_document');

        return view('frontend.bookingLists.show', compact('bookingList'));
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
