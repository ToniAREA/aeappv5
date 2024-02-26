@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.employeeHoliday.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employee-holidays.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.employeeHoliday.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeHoliday.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.employeeHoliday.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeHoliday.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_date">{{ trans('cruds.employeeHoliday.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeHoliday.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="days_taken">{{ trans('cruds.employeeHoliday.fields.days_taken') }}</label>
                <input class="form-control {{ $errors->has('days_taken') ? 'is-invalid' : '' }}" type="number" name="days_taken" id="days_taken" value="{{ old('days_taken', '') }}" step="1" required>
                @if($errors->has('days_taken'))
                    <span class="text-danger">{{ $errors->first('days_taken') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeHoliday.fields.days_taken_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_completed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_completed" value="0">
                    <input class="form-check-input" type="checkbox" name="is_completed" id="is_completed" value="1" {{ old('is_completed', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_completed">{{ trans('cruds.employeeHoliday.fields.is_completed') }}</label>
                </div>
                @if($errors->has('is_completed'))
                    <span class="text-danger">{{ $errors->first('is_completed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeHoliday.fields.is_completed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type">{{ trans('cruds.employeeHoliday.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeHoliday.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.employeeHoliday.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeHoliday.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internalnotes">{{ trans('cruds.employeeHoliday.fields.internalnotes') }}</label>
                <input class="form-control {{ $errors->has('internalnotes') ? 'is-invalid' : '' }}" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', '') }}">
                @if($errors->has('internalnotes'))
                    <span class="text-danger">{{ $errors->first('internalnotes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeHoliday.fields.internalnotes_helper') }}</span>
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