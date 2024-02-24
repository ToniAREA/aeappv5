@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.bookingList.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.booking-lists.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.bookingList.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="client_id">{{ trans('cruds.bookingList.fields.client') }}</label>
                            <select class="form-control select2" name="client_id" id="client_id" required>
                                @foreach($clients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="boat_id">{{ trans('cruds.bookingList.fields.boat') }}</label>
                            <select class="form-control select2" name="boat_id" id="boat_id" required>
                                @foreach($boats as $id => $entry)
                                    <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('boat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('boat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.boat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="employee_id">{{ trans('cruds.bookingList.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id">
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="booking_slot_id">{{ trans('cruds.bookingList.fields.booking_slot') }}</label>
                            <select class="form-control select2" name="booking_slot_id" id="booking_slot_id">
                                @foreach($booking_slots as $id => $entry)
                                    <option value="{{ $id }}" {{ old('booking_slot_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('booking_slot'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('booking_slot') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.booking_slot_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.bookingList.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date') }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hours">{{ trans('cruds.bookingList.fields.hours') }}</label>
                            <input class="form-control" type="number" name="hours" id="hours" value="{{ old('hours', '1') }}" step="1" min="1" max="100">
                            @if($errors->has('hours'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hours') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.hours_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="start_time">{{ trans('cruds.bookingList.fields.start_time') }}</label>
                            <input class="form-control timepicker" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                            @if($errors->has('start_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.start_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="end_time">{{ trans('cruds.bookingList.fields.end_time') }}</label>
                            <input class="form-control timepicker" type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                            @if($errors->has('end_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.end_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hourly_rate">{{ trans('cruds.bookingList.fields.hourly_rate') }}</label>
                            <input class="form-control" type="number" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', '') }}" step="0.01">
                            @if($errors->has('hourly_rate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hourly_rate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.hourly_rate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_amount">{{ trans('cruds.bookingList.fields.total_amount') }}</label>
                            <input class="form-control" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', '') }}" step="0.01">
                            @if($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.total_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.bookingList.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.bookingList.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="confirmed" id="confirmed" value="1" required {{ old('confirmed', 0) == 1 ? 'checked' : '' }}>
                                <label class="required" for="confirmed">{{ trans('cruds.bookingList.fields.confirmed') }}</label>
                            </div>
                            @if($errors->has('confirmed'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('confirmed') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.confirmed_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.bookingList.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="completed_at">{{ trans('cruds.bookingList.fields.completed_at') }}</label>
                            <input class="form-control datetime" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at') }}">
                            @if($errors->has('completed_at'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('completed_at') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.completed_at_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection