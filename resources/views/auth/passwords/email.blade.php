@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="login-box">
            <!-- Logo o título -->
            <div class="login-logo">
                <a href="{{ url('/') }}">
                    {{ trans('panel.site_title') }}
                </a>
            </div>

            <!-- Mensaje -->
            <p class="login-box-msg">
                {{ trans('global.reset_password') }}
            </p>

            <!-- Mensajes de alerta -->
            @if(session('status'))
                <div class="alert alert-info" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Formulario -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Campo de email -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Botón de envío -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ trans('global.send_password') }}
                    </button>
                </div>
            </form>

            <!-- Enlace a la página de inicio de sesión -->
            <p class="mb-0">
                <a href="{{ route('login') }}">
                    {{ trans('global.login') }}
                </a>
            </p>
        </div>
    </div>
@endsection