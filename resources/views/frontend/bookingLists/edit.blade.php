@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.bookingList.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.booking-lists.update", [$bookingList->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id">{{ trans('cruds.bookingList.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $bookingList->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                                    <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $bookingList->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                                    <option value="{{ $id }}" {{ (old('boat_id') ? old('boat_id') : $bookingList->boat->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                                    <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $bookingList->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <label class="required" for="date">{{ trans('cruds.bookingList.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $bookingList->date) }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="hours">{{ trans('cruds.bookingList.fields.hours') }}</label>
                            <input class="form-control" type="number" name="hours" id="hours" value="{{ old('hours', $bookingList->hours) }}" step="1" min="1" max="100">
                            @if($errors->has('hours'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hours') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.hours_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="start_time">{{ trans('cruds.bookingList.fields.start_time') }}</label>
                            <input class="form-control timepicker" type="text" name="start_time" id="start_time" value="{{ old('start_time', $bookingList->start_time) }}" required>
                            @if($errors->has('start_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.start_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="end_time">{{ trans('cruds.bookingList.fields.end_time') }}</label>
                            <input class="form-control timepicker" type="text" name="end_time" id="end_time" value="{{ old('end_time', $bookingList->end_time) }}" required>
                            @if($errors->has('end_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.end_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="hour_rate">{{ trans('cruds.bookingList.fields.hour_rate') }}</label>
                            <input class="form-control" type="number" name="hour_rate" id="hour_rate" value="{{ old('hour_rate', $bookingList->hour_rate) }}" step="0.01" required>
                            @if($errors->has('hour_rate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('hour_rate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.hour_rate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="total_price">{{ trans('cruds.bookingList.fields.total_price') }}</label>
                            <input class="form-control" type="number" name="total_price" id="total_price" value="{{ old('total_price', $bookingList->total_price) }}" step="0.01" required>
                            @if($errors->has('total_price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.total_price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.bookingList.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', $bookingList->notes) }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.bookingList.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $bookingList->internal_notes) }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="confirmed" id="confirmed" value="1" {{ $bookingList->confirmed || old('confirmed', 0) === 1 ? 'checked' : '' }} required>
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
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', $bookingList->status) }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingList.fields.status_helper') }}</span>
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