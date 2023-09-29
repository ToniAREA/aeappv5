@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.availability.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.availabilities.update", [$availability->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="employee_id">{{ trans('cruds.availability.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id" required>
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $availability->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.availability.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="weekday">{{ trans('cruds.availability.fields.weekday') }}</label>
                            <input class="form-control" type="text" name="weekday" id="weekday" value="{{ old('weekday', $availability->weekday) }}" required>
                            @if($errors->has('weekday'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weekday') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.availability.fields.weekday_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="star_time">{{ trans('cruds.availability.fields.star_time') }}</label>
                            <input class="form-control datetime" type="text" name="star_time" id="star_time" value="{{ old('star_time', $availability->star_time) }}" required>
                            @if($errors->has('star_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('star_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.availability.fields.star_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="end_time">{{ trans('cruds.availability.fields.end_time') }}</label>
                            <input class="form-control datetime" type="text" name="end_time" id="end_time" value="{{ old('end_time', $availability->end_time) }}" required>
                            @if($errors->has('end_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.availability.fields.end_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="rate_multiplier">{{ trans('cruds.availability.fields.rate_multiplier') }}</label>
                            <input class="form-control" type="number" name="rate_multiplier" id="rate_multiplier" value="{{ old('rate_multiplier', $availability->rate_multiplier) }}" step="0.01" required>
                            @if($errors->has('rate_multiplier'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rate_multiplier') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.availability.fields.rate_multiplier_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.availability.fields.status') }}</label>
                            <select class="form-control" name="status" id="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Availability::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', $availability->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection