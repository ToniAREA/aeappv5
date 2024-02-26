@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.employeeHoliday.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.employee-holidays.update", [$employeeHoliday->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="employee_id">{{ trans('cruds.employeeHoliday.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id" required>
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $employeeHoliday->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeHoliday.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="start_date">{{ trans('cruds.employeeHoliday.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date', $employeeHoliday->start_date) }}" required>
                            @if($errors->has('start_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeHoliday.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="end_date">{{ trans('cruds.employeeHoliday.fields.end_date') }}</label>
                            <input class="form-control date" type="text" name="end_date" id="end_date" value="{{ old('end_date', $employeeHoliday->end_date) }}" required>
                            @if($errors->has('end_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeHoliday.fields.end_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="days_taken">{{ trans('cruds.employeeHoliday.fields.days_taken') }}</label>
                            <input class="form-control" type="number" name="days_taken" id="days_taken" value="{{ old('days_taken', $employeeHoliday->days_taken) }}" step="1" required>
                            @if($errors->has('days_taken'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('days_taken') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeHoliday.fields.days_taken_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_completed" value="0">
                                <input type="checkbox" name="is_completed" id="is_completed" value="1" {{ $employeeHoliday->is_completed || old('is_completed', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_completed">{{ trans('cruds.employeeHoliday.fields.is_completed') }}</label>
                            </div>
                            @if($errors->has('is_completed'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_completed') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeHoliday.fields.is_completed_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="type">{{ trans('cruds.employeeHoliday.fields.type') }}</label>
                            <input class="form-control" type="text" name="type" id="type" value="{{ old('type', $employeeHoliday->type) }}">
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeHoliday.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.employeeHoliday.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', $employeeHoliday->notes) }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeHoliday.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internalnotes">{{ trans('cruds.employeeHoliday.fields.internalnotes') }}</label>
                            <input class="form-control" type="text" name="internalnotes" id="internalnotes" value="{{ old('internalnotes', $employeeHoliday->internalnotes) }}">
                            @if($errors->has('internalnotes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internalnotes') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection