@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.availability.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.availabilities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.availability.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.availability.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.availability.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.availability.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="weekday">{{ trans('cruds.availability.fields.weekday') }}</label>
                <input class="form-control {{ $errors->has('weekday') ? 'is-invalid' : '' }}" type="text" name="weekday" id="weekday" value="{{ old('weekday', '') }}" required>
                @if($errors->has('weekday'))
                    <span class="text-danger">{{ $errors->first('weekday') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.availability.fields.weekday_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.availability.fields.start_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @if($errors->has('start_time'))
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.availability.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.availability.fields.end_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                @if($errors->has('end_time'))
                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.availability.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rate_multiplier">{{ trans('cruds.availability.fields.rate_multiplier') }}</label>
                <input class="form-control {{ $errors->has('rate_multiplier') ? 'is-invalid' : '' }}" type="number" name="rate_multiplier" id="rate_multiplier" value="{{ old('rate_multiplier', '1') }}" step="0.01" required>
                @if($errors->has('rate_multiplier'))
                    <span class="text-danger">{{ $errors->first('rate_multiplier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.availability.fields.rate_multiplier_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.availability.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Availability::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'available') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.availability.fields.status_helper') }}</span>
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