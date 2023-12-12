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
                {{ trans('global.reset_password') }}
            </p>

            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">

                        @if($errors->has('email'))
                            <div class="m-2 text-danger text-center">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-warning btn-flat btn-block">
                            {{ trans('global.send_password') }}
                        </button>
                    </div>
                </div>
                <p class="mt-4 m-1 text-center">
                <a class="text-center text-secondary" href="{{ route('register') }}">
                    Don't have an account?
                </a>
            </form>
        </div>
    </div>
</div>
@endsection