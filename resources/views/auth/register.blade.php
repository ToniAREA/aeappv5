@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="{{ route('home') }}">
                {{ trans('panel.site_title') }}
            </a>
            <br>
            <h4>BESPOKE MARINE ELECTRONICS</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="mb-2 login-box-msg">NEW {{ trans('global.register') }}</p>
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                            <div class="m-2 text-center invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="m-2 text-center invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="m-2 text-center invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-warning btn-block btn-flat">
                            {{ trans('global.register') }}
                        </button>
                    </div>
                </div>
                <p class="mt-4 m-1 text-center">
                <a class="text-center text-secondary" href="{{ route('login') }}">
                    Already have an account?
                </a>
            </p>
            </form>
        </div>
    </div>
</div>
@endsection