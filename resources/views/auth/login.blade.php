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
            <p class="mb-2 login-box-msg">
                ACCESS TO OUR SYSTEM
            </p>

            @if(session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">

                    @if($errors->has('email'))
                        <div class="m-2 text-center invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ trans('global.login_password') }}">

                    @if($errors->has('password'))
                        <div class="m-2 text-center invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>


                <div class="row">
                    <div class="col">
                        <div class="m-2 icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ trans('global.remember_me') }}</label>
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-warning btn-block btn-flat">
                            {{ trans('global.login') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            @if(Route::has('password.request'))
                <p class="mt-4 m-1 text-center">
                    <a class="text-center text-secondary" href="{{ route('password.request') }}">
                        {{ trans('global.forgot_password') }}
                    </a>
                </p>
            @endif
            <p class="mb-1 text-center">
                <a class="text-center text-secondary" href="{{ route('register') }}">
                    Don't have an account?
                </a>
            </p>
        </div>
    </div>
</div>
@endsection