@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.bank.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.banks.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.bank.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="branch">{{ trans('cruds.bank.fields.branch') }}</label>
                            <input class="form-control" type="text" name="branch" id="branch" value="{{ old('branch', '') }}">
                            @if($errors->has('branch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.branch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="account_number">{{ trans('cruds.bank.fields.account_number') }}</label>
                            <input class="form-control" type="text" name="account_number" id="account_number" value="{{ old('account_number', '') }}" required>
                            @if($errors->has('account_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.account_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="account_name">{{ trans('cruds.bank.fields.account_name') }}</label>
                            <input class="form-control" type="text" name="account_name" id="account_name" value="{{ old('account_name', '') }}">
                            @if($errors->has('account_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.account_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="swift_code">{{ trans('cruds.bank.fields.swift_code') }}</label>
                            <input class="form-control" type="text" name="swift_code" id="swift_code" value="{{ old('swift_code', '') }}">
                            @if($errors->has('swift_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('swift_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.swift_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.bank.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', '') }}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="join_date">{{ trans('cruds.bank.fields.join_date') }}</label>
                            <input class="form-control date" type="text" name="join_date" id="join_date" value="{{ old('join_date') }}">
                            @if($errors->has('join_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('join_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.join_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="is_active">{{ trans('cruds.bank.fields.is_active') }}</label>
                            <input class="form-control" type="text" name="is_active" id="is_active" value="{{ old('is_active', '') }}">
                            @if($errors->has('is_active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.is_active_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="current_balance">{{ trans('cruds.bank.fields.current_balance') }}</label>
                            <input class="form-control" type="number" name="current_balance" id="current_balance" value="{{ old('current_balance', '') }}" step="0.01">
                            @if($errors->has('current_balance'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('current_balance') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.current_balance_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.bank.fields.notes') }}</label>
                            <input class="form-control" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="internal_notes">{{ trans('cruds.bank.fields.internal_notes') }}</label>
                            <input class="form-control" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                            @if($errors->has('internal_notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('internal_notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.internal_notes_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_a">{{ trans('cruds.bank.fields.link_a') }}</label>
                            <input class="form-control" type="text" name="link_a" id="link_a" value="{{ old('link_a', '') }}">
                            @if($errors->has('link_a'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_a') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.link_a_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_a_description">{{ trans('cruds.bank.fields.link_a_description') }}</label>
                            <input class="form-control" type="text" name="link_a_description" id="link_a_description" value="{{ old('link_a_description', '') }}">
                            @if($errors->has('link_a_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_a_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.link_a_description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_b">{{ trans('cruds.bank.fields.link_b') }}</label>
                            <input class="form-control" type="text" name="link_b" id="link_b" value="{{ old('link_b', '') }}">
                            @if($errors->has('link_b'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_b') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.link_b_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="link_b_description">{{ trans('cruds.bank.fields.link_b_description') }}</label>
                            <input class="form-control" type="text" name="link_b_description" id="link_b_description" value="{{ old('link_b_description', '') }}">
                            @if($errors->has('link_b_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_b_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bank.fields.link_b_description_helper') }}</span>
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