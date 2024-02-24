@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.bookingList.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.booking-lists.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.client') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->client->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.boat') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->boat->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.employee') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->employee->id_employee ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.booking_slot') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->booking_slot->star_time ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.hours') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->hours }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.start_time') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->start_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.end_time') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->end_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.hourly_rate') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->hourly_rate }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.total_amount') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->total_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.internal_notes') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->internal_notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.confirmed') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $bookingList->confirmed ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.status') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->status }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bookingList.fields.completed_at') }}
                                    </th>
                                    <td>
                                        {{ $bookingList->completed_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.booking-lists.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection