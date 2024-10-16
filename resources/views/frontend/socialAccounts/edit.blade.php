@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.edit') }} {{ trans('cruds.socialAccount.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.social-accounts.update', [$socialAccount->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="user_id">{{ trans('cruds.socialAccount.fields.user') }}</label>
                                <select class="form-control select2" name="user_id" id="user_id">
                                    @foreach ($users as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ (old('user_id') ? old('user_id') : $socialAccount->user->id ?? '') == $id ? 'selected' : '' }}>
                                            {{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('user') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.socialAccount.fields.user_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="provider">{{ trans('cruds.socialAccount.fields.provider') }}</label>
                                <input class="form-control" type="text" name="provider" id="provider"
                                    value="{{ old('provider', $socialAccount->provider) }}">
                                @if ($errors->has('provider'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('provider') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.socialAccount.fields.provider_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="id_provider">{{ trans('cruds.socialAccount.fields.id_provider') }}</label>
                                <input class="form-control" type="text" name="id_provider" id="id_provider"
                                    value="{{ old('id_provider', $socialAccount->id_provider) }}">
                                @if ($errors->has('id_provider'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('id_provider') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.socialAccount.fields.id_provider_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="token">{{ trans('cruds.socialAccount.fields.token') }}</label>
                                <input class="form-control" type="text" name="token" id="token"
                                    value="{{ old('token', $socialAccount->token) }}">
                                @if ($errors->has('token'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('token') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.socialAccount.fields.token_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="refresh_token">{{ trans('cruds.socialAccount.fields.refresh_token') }}</label>
                                <input class="form-control" type="text" name="refresh_token" id="refresh_token"
                                    value="{{ old('refresh_token', $socialAccount->refresh_token) }}">
                                @if ($errors->has('refresh_token'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('refresh_token') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.socialAccount.fields.refresh_token_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="expires_in">{{ trans('cruds.socialAccount.fields.expires_in') }}</label>
                                <input class="form-control" type="number" name="expires_in" id="expires_in"
                                    value="{{ old('expires_in', $socialAccount->expires_in) }}" step="1">
                                @if ($errors->has('expires_in'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('expires_in') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.socialAccount.fields.expires_in_helper') }}</span>
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
