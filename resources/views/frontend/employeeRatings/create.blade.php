@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.employeeRating.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.employee-ratings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">{{ trans('cruds.employeeRating.fields.employee') }}</label>
                            <select class="form-control select2" name="employee_id" id="employee_id">
                                @foreach($employees as $id => $entry)
                                    <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('employee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employee') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeRating.fields.employee_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="from_user_id">{{ trans('cruds.employeeRating.fields.from_user') }}</label>
                            <select class="form-control select2" name="from_user_id" id="from_user_id">
                                @foreach($from_users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('from_user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('from_user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('from_user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeRating.fields.from_user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="from_client_id">{{ trans('cruds.employeeRating.fields.from_client') }}</label>
                            <select class="form-control select2" name="from_client_id" id="from_client_id">
                                @foreach($from_clients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('from_client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('from_client'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('from_client') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeRating.fields.from_client_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_wlist_id">{{ trans('cruds.employeeRating.fields.for_wlist') }}</label>
                            <select class="form-control select2" name="for_wlist_id" id="for_wlist_id">
                                @foreach($for_wlists as $id => $entry)
                                    <option value="{{ $id }}" {{ old('for_wlist_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_wlist'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_wlist') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeRating.fields.for_wlist_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="for_wlog_id">{{ trans('cruds.employeeRating.fields.for_wlog') }}</label>
                            <select class="form-control select2" name="for_wlog_id" id="for_wlog_id">
                                @foreach($for_wlogs as $id => $entry)
                                    <option value="{{ $id }}" {{ old('for_wlog_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('for_wlog'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('for_wlog') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeRating.fields.for_wlog_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="rating">{{ trans('cruds.employeeRating.fields.rating') }}</label>
                            <input class="form-control" type="number" name="rating" id="rating" value="{{ old('rating', '') }}" step="1">
                            @if($errors->has('rating'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rating') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeRating.fields.rating_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.employeeRating.fields.comment') }}</label>
                            <input class="form-control" type="text" name="comment" id="comment" value="{{ old('comment', '') }}">
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employeeRating.fields.comment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="show_online" value="0">
                                <input type="checkbox" name="show_online" id="show_online" value="1" {{ old('show_online', 0) == 1 ? 'checked' : '' }}>
                                <label for="show_online">{{ trans('cruds.employeeRating.fields.show_online') }}</label>
                            </div>
                            @if($errors->has('show_online'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('show_online') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection