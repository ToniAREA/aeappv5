@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employeeRating.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employee-ratings.update", [$employeeRating->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="employee_id">{{ trans('cruds.employeeRating.fields.employee') }}</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee_id" id="employee_id">
                    @foreach($employees as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employee_id') ? old('employee_id') : $employeeRating->employee->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employee'))
                    <span class="text-danger">{{ $errors->first('employee') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeRating.fields.employee_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from_user_id">{{ trans('cruds.employeeRating.fields.from_user') }}</label>
                <select class="form-control select2 {{ $errors->has('from_user') ? 'is-invalid' : '' }}" name="from_user_id" id="from_user_id">
                    @foreach($from_users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('from_user_id') ? old('from_user_id') : $employeeRating->from_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('from_user'))
                    <span class="text-danger">{{ $errors->first('from_user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeRating.fields.from_user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from_client_id">{{ trans('cruds.employeeRating.fields.from_client') }}</label>
                <select class="form-control select2 {{ $errors->has('from_client') ? 'is-invalid' : '' }}" name="from_client_id" id="from_client_id">
                    @foreach($from_clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('from_client_id') ? old('from_client_id') : $employeeRating->from_client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('from_client'))
                    <span class="text-danger">{{ $errors->first('from_client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeRating.fields.from_client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="for_wlist_id">{{ trans('cruds.employeeRating.fields.for_wlist') }}</label>
                <select class="form-control select2 {{ $errors->has('for_wlist') ? 'is-invalid' : '' }}" name="for_wlist_id" id="for_wlist_id">
                    @foreach($for_wlists as $id => $entry)
                        <option value="{{ $id }}" {{ (old('for_wlist_id') ? old('for_wlist_id') : $employeeRating->for_wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('for_wlist'))
                    <span class="text-danger">{{ $errors->first('for_wlist') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeRating.fields.for_wlist_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="for_wlog_id">{{ trans('cruds.employeeRating.fields.for_wlog') }}</label>
                <select class="form-control select2 {{ $errors->has('for_wlog') ? 'is-invalid' : '' }}" name="for_wlog_id" id="for_wlog_id">
                    @foreach($for_wlogs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('for_wlog_id') ? old('for_wlog_id') : $employeeRating->for_wlog->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('for_wlog'))
                    <span class="text-danger">{{ $errors->first('for_wlog') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeRating.fields.for_wlog_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rating">{{ trans('cruds.employeeRating.fields.rating') }}</label>
                <input class="form-control {{ $errors->has('rating') ? 'is-invalid' : '' }}" type="number" name="rating" id="rating" value="{{ old('rating', $employeeRating->rating) }}" step="1">
                @if($errors->has('rating'))
                    <span class="text-danger">{{ $errors->first('rating') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeRating.fields.rating_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.employeeRating.fields.comment') }}</label>
                <input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment" id="comment" value="{{ old('comment', $employeeRating->comment) }}">
                @if($errors->has('comment'))
                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeRating.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_online') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_online" value="0">
                    <input class="form-check-input" type="checkbox" name="show_online" id="show_online" value="1" {{ $employeeRating->show_online || old('show_online', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_online">{{ trans('cruds.employeeRating.fields.show_online') }}</label>
                </div>
                @if($errors->has('show_online'))
                    <span class="text-danger">{{ $errors->first('show_online') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.employeeRating.fields.show_online_helper') }}</span>
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