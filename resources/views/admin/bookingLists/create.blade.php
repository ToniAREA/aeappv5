@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bookingList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.booking-lists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.bookingList.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.bookingList.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $entry)
                        <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <span class="text-danger">{{ $errors->first('client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="boat_id">{{ trans('cruds.bookingList.fields.boat') }}</label>
                <select class="form-control select2 {{ $errors->has('boat') ? 'is-invalid' : '' }}" name="boat_id" id="boat_id" required>
                    @foreach($boats as $id => $entry)
                        <option value="{{ $id }}" {{ old('boat_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('boat'))
                    <span class="text-danger">{{ $errors->first('boat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.boat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="employee_id">{{ trans('cruds.bookingList.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id">
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.bookingList.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hours">{{ trans('cruds.bookingList.fields.hours') }}</label>
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="number" name="hours" id="hours" value="{{ old('hours', '1') }}" step="1" min="1" max="100">
                @if($errors->has('hours'))
                    <span class="text-danger">{{ $errors->first('hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.bookingList.fields.start_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @if($errors->has('start_time'))
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.bookingList.fields.end_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                @if($errors->has('end_time'))
                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hour_rate">{{ trans('cruds.bookingList.fields.hour_rate') }}</label>
                <input class="form-control {{ $errors->has('hour_rate') ? 'is-invalid' : '' }}" type="number" name="hour_rate" id="hour_rate" value="{{ old('hour_rate', '') }}" step="0.01" required>
                @if($errors->has('hour_rate'))
                    <span class="text-danger">{{ $errors->first('hour_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.hour_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_price">{{ trans('cruds.bookingList.fields.total_price') }}</label>
                <input class="form-control {{ $errors->has('total_price') ? 'is-invalid' : '' }}" type="number" name="total_price" id="total_price" value="{{ old('total_price', '') }}" step="0.01" required>
                @if($errors->has('total_price'))
                    <span class="text-danger">{{ $errors->first('total_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.total_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.bookingList.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.bookingList.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('confirmed') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="confirmed" id="confirmed" value="1" required {{ old('confirmed', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="confirmed">{{ trans('cruds.bookingList.fields.confirmed') }}</label>
                </div>
                @if($errors->has('confirmed'))
                    <span class="text-danger">{{ $errors->first('confirmed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.confirmed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.bookingList.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
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



@endsection