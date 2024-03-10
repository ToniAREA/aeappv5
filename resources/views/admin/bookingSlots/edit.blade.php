@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bookingSlot.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.booking-slots.update", [$bookingSlot->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="employee_id">{{ trans('cruds.bookingSlot.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id" required>
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $bookingSlot->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingSlot.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="star_time">{{ trans('cruds.bookingSlot.fields.star_time') }}</label>
                <input class="form-control datetime {{ $errors->has('star_time') ? 'is-invalid' : '' }}" type="text" name="star_time" id="star_time" value="{{ old('star_time', $bookingSlot->star_time) }}" required>
                @if($errors->has('star_time'))
                    <span class="text-danger">{{ $errors->first('star_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingSlot.fields.star_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.bookingSlot.fields.end_time') }}</label>
                <input class="form-control datetime {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $bookingSlot->end_time) }}" required>
                @if($errors->has('end_time'))
                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingSlot.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rate_multiplier">{{ trans('cruds.bookingSlot.fields.rate_multiplier') }}</label>
                <input class="form-control {{ $errors->has('rate_multiplier') ? 'is-invalid' : '' }}" type="number" name="rate_multiplier" id="rate_multiplier" value="{{ old('rate_multiplier', $bookingSlot->rate_multiplier) }}" step="0.01" required>
                @if($errors->has('rate_multiplier'))
                    <span class="text-danger">{{ $errors->first('rate_multiplier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingSlot.fields.rate_multiplier_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_online') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_online" value="0">
                    <input class="form-check-input" type="checkbox" name="show_online" id="show_online" value="1" {{ $bookingSlot->show_online || old('show_online', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_online">{{ trans('cruds.bookingSlot.fields.show_online') }}</label>
                </div>
                @if($errors->has('show_online'))
                    <span class="text-danger">{{ $errors->first('show_online') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingSlot.fields.show_online_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('booked') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="booked" value="0">
                    <input class="form-check-input" type="checkbox" name="booked" id="booked" value="1" {{ $bookingSlot->booked || old('booked', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="booked">{{ trans('cruds.bookingSlot.fields.booked') }}</label>
                </div>
                @if($errors->has('booked'))
                    <span class="text-danger">{{ $errors->first('booked') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingSlot.fields.booked_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.bookingSlot.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $bookingSlot->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
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



@endsection