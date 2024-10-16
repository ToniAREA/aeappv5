@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.userSetting.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.user-settings.store') }}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="user_id">{{ trans('cruds.userSetting.fields.user') }}</label>
                                <select class="form-control select2" name="user_id" id="user_id">
                                    @foreach ($users as $id => $entry)
                                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('user') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.userSetting.fields.user_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="title">{{ trans('cruds.userSetting.fields.title') }}</label>
                                <input class="form-control" type="text" name="title" id="title"
                                    value="{{ old('title', '') }}">
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.userSetting.fields.title_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="value">{{ trans('cruds.userSetting.fields.value') }}</label>
                                <textarea class="form-control" name="value" id="value">{{ old('value') }}</textarea>
                                @if ($errors->has('value'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('value') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.userSetting.fields.value_helper') }}</span>
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
