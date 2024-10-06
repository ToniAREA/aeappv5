@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="login-box">
            @include('partials.logo')

            <!-- Mensaje de inicio de sesión -->
            <p class="login-box-msg">
                {{ trans('global.login') }}
            </p>

            <!-- Mensajes de alerta -->
            @if (session()->has('message'))
                <div class="alert alert-info">
                    {{ session()->get('message') }}
                </div>
            @endif

            <!-- Formulario de login -->
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Campo de email -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo de contraseña -->
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" required placeholder="{{ trans('global.login_password') }}" name="password">

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Checkbox para mostrar/ocultar contraseña -->
                <div class="form-group show-password">
                    <input type="checkbox" id="show-password">
                    <label for="show-password">{{ trans('global.show_password') }}</label>
                </div>

                
                <!-- Recordarme y botón de inicio de sesión -->

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ trans('global.login') }}
                    </button>
            </div>

                <div class="form-group remember-login">
                    <div class="custom-checkbox">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">{{ trans('global.remember_me') }}</label>
                    </div>
                </div>
            </form>

            <!-- Enlaces adicionales -->
            @if (Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">
                        {{ trans('global.forgot_password') }}
                    </a>
                </p>
            @endif
            <p class="">
                <a href="{{ route('register') }}">
                    {{ trans('global.register') }}
                </a>
            </p>
            <p class="text-center">
                -- Or access with --
            </p>

            <!-- Botón de Google para acceso -->
            <div class="text-center">
                <a href="{{ url('auth/google') }}" class="btn btn-primary text-white btn-block mb-2">
                    <i class="fab fa-google"></i> {{ __('Google') }}
                </a>
            </div>
        </div>
        
    </div>

    <!-- JavaScript para mostrar/ocultar la contraseña -->
    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
@endsection