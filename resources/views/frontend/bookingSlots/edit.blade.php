@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.bookingSlot.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.booking-slots.update", [$bookingSlot->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_online" value="0">
                                <input type="checkbox" name="is_online" id="is_online" value="1" {{ $bookingSlot->is_online || old('is_online', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_online">{{ trans('cruds.bookingSlot.fields.is_online') }}</label>
                            </div>
                            @if($errors->has('is_online'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_online') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingSlot.fields.is_online_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="employee_id">{{ trans('cruds.bookingSlot.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id" required>
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $bookingSlot->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingSlot.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="star_time">{{ trans('cruds.bookingSlot.fields.star_time') }}</label>
                            <input class="form-control datetime" type="text" name="star_time" id="star_time" value="{{ old('star_time', $bookingSlot->star_time) }}" required>
                            @if($errors->has('star_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('star_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingSlot.fields.star_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="end_time">{{ trans('cruds.bookingSlot.fields.end_time') }}</label>
                            <input class="form-control datetime" type="text" name="end_time" id="end_time" value="{{ old('end_time', $bookingSlot->end_time) }}" required>
                            @if($errors->has('end_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingSlot.fields.end_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="rate_multiplier">{{ trans('cruds.bookingSlot.fields.rate_multiplier') }}</label>
                            <input class="form-control" type="number" name="rate_multiplier" id="rate_multiplier" value="{{ old('rate_multiplier', $bookingSlot->rate_multiplier) }}" step="0.01" required>
                            @if($errors->has('rate_multiplier'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rate_multiplier') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingSlot.fields.rate_multiplier_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="booked" value="0">
                                <input type="checkbox" name="booked" id="booked" value="1" {{ $bookingSlot->booked || old('booked', 0) === 1 ? 'checked' : '' }}>
                                <label for="booked">{{ trans('cruds.bookingSlot.fields.booked') }}</label>
                            </div>
                            @if($errors->has('booked'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('booked') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingSlot.fields.booked_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="status_id">{{ trans('cruds.bookingSlot.fields.status') }}</label>
                            <select class="form-control select2" name="status_id" id="status_id" required>
                                @foreach($statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $bookingSlot->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bookingSlot.fields.status_helper') }}</span>
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