@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.bookingSlot.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.booking-slots.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.booking-slots.index') }}">
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