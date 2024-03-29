@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employeeAttendance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employee-attendances.update", [$employeeAttendance->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="employee_id">{{ trans('cruds.employeeAttendance.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id">
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $employeeAttendance->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeAttendance.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.employeeAttendance.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $employeeAttendance->date) }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeAttendance.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="arrival_time">{{ trans('cruds.employeeAttendance.fields.arrival_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('arrival_time') ? 'is-invalid' : '' }}" type="text" name="arrival_time" id="arrival_time" value="{{ old('arrival_time', $employeeAttendance->arrival_time) }}">
                @if($errors->has('arrival_time'))
                    <span class="text-danger">{{ $errors->first('arrival_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeAttendance.fields.arrival_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="departure_time">{{ trans('cruds.employeeAttendance.fields.departure_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('departure_time') ? 'is-invalid' : '' }}" type="text" name="departure_time" id="departure_time" value="{{ old('departure_time', $employeeAttendance->departure_time) }}">
                @if($errors->has('departure_time'))
                    <span class="text-danger">{{ $errors->first('departure_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeAttendance.fields.departure_time_helper') }}</span>
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