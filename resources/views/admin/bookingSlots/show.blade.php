@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bookingSlot.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.booking-slots.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingSlot.fields.id') }}
                        </th>
                        <td>
                            {{ $bookingSlot->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingSlot.fields.employee') }}
                        </th>
                        <td>
                            {{ $bookingSlot->employee->id_employee ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingSlot.fields.star_time') }}
                        </th>
                        <td>
                            {{ $bookingSlot->star_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingSlot.fields.end_time') }}
                        </th>
                        <td>
                            {{ $bookingSlot->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingSlot.fields.rate_multiplier') }}
                        </th>
                        <td>
                            {{ $bookingSlot->rate_multiplier }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingSlot.fields.show_online') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bookingSlot->show_online ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingSlot.fields.booked') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $bookingSlot->booked ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingSlot.fields.status') }}
                        </th>
                        <td>
                            {{ $bookingSlot->status->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.booking-slots.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#booking_slot_booking_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.bookingList.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="booking_slot_booking_lists">
            @includeIf('admin.bookingSlots.relationships.bookingSlotBookingLists', ['bookingLists' => $bookingSlot->bookingSlotBookingLists])
        </div>
    </div>
</div>

@endsection