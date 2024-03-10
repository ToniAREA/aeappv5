@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bookingList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.booking-lists.update", [$bookingList->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.bookingList.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $bookingList->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $bookingList->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (old('boat_id') ? old('boat_id') : $bookingList->boat->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $bookingList->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booking_slot_id">{{ trans('cruds.bookingList.fields.booking_slot') }}</label>
                <select class="form-control select2 {{ $errors->has('booking_slot') ? 'is-invalid' : '' }}" name="booking_slot_id" id="booking_slot_id">
                    @foreach($booking_slots as $id => $entry)
                        <option value="{{ $id }}" {{ (old('booking_slot_id') ? old('booking_slot_id') : $bookingList->booking_slot->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('booking_slot'))
                    <span class="text-danger">{{ $errors->first('booking_slot') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.booking_slot_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.bookingList.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $bookingList->date) }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hours">{{ trans('cruds.bookingList.fields.hours') }}</label>
                <input class="form-control {{ $errors->has('hours') ? 'is-invalid' : '' }}" type="number" name="hours" id="hours" value="{{ old('hours', $bookingList->hours) }}" step="1" min="1" max="100">
                @if($errors->has('hours'))
                    <span class="text-danger">{{ $errors->first('hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.bookingList.fields.start_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $bookingList->start_time) }}" required>
                @if($errors->has('start_time'))
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.bookingList.fields.end_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $bookingList->end_time) }}" required>
                @if($errors->has('end_time'))
                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hourly_rate">{{ trans('cruds.bookingList.fields.hourly_rate') }}</label>
                <input class="form-control {{ $errors->has('hourly_rate') ? 'is-invalid' : '' }}" type="number" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', $bookingList->hourly_rate) }}" step="0.01">
                @if($errors->has('hourly_rate'))
                    <span class="text-danger">{{ $errors->first('hourly_rate') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.hourly_rate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_amount">{{ trans('cruds.bookingList.fields.total_amount') }}</label>
                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $bookingList->total_amount) }}" step="0.01">
                @if($errors->has('total_amount'))
                    <span class="text-danger">{{ $errors->first('total_amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.total_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('confirmed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="confirmed" value="0">
                    <input class="form-check-input" type="checkbox" name="confirmed" id="confirmed" value="1" {{ $bookingList->confirmed || old('confirmed', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="confirmed">{{ trans('cruds.bookingList.fields.confirmed') }}</label>
                </div>
                @if($errors->has('confirmed'))
                    <span class="text-danger">{{ $errors->first('confirmed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.confirmed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.bookingList.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $bookingList->status) }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_invoiced') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_invoiced" value="0">
                    <input class="form-check-input" type="checkbox" name="is_invoiced" id="is_invoiced" value="1" {{ $bookingList->is_invoiced || old('is_invoiced', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_invoiced">{{ trans('cruds.bookingList.fields.is_invoiced') }}</label>
                </div>
                @if($errors->has('is_invoiced'))
                    <span class="text-danger">{{ $errors->first('is_invoiced') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.is_invoiced_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.bookingList.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $bookingList->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.bookingList.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', $bookingList->internal_notes) }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="completed_at">{{ trans('cruds.bookingList.fields.completed_at') }}</label>
                <input class="form-control datetime {{ $errors->has('completed_at') ? 'is-invalid' : '' }}" type="text" name="completed_at" id="completed_at" value="{{ old('completed_at', $bookingList->completed_at) }}">
                @if($errors->has('completed_at'))
                    <span class="text-danger">{{ $errors->first('completed_at') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.completed_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="financial_document_id">{{ trans('cruds.bookingList.fields.financial_document') }}</label>
                <select class="form-control select2 {{ $errors->has('financial_document') ? 'is-invalid' : '' }}" name="financial_document_id" id="financial_document_id">
                    @foreach($financial_documents as $id => $entry)
                        <option value="{{ $id }}" {{ (old('financial_document_id') ? old('financial_document_id') : $bookingList->financial_document->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('financial_document'))
                    <span class="text-danger">{{ $errors->first('financial_document') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookingList.fields.financial_document_helper') }}</span>
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