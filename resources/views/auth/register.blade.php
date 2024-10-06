@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="login-box">

            <!-- Logo o título -->
            @include('partials.logo')


            <!-- Mensaje de registro -->
            <p class="login-box-msg">
                {{ trans('global.register') }}
            </p>

            <!-- Mensajes de alerta -->
            @if (session()->has('message'))
                <div class="alert alert-info">
                    {{ session()->get('message') }}
                </div>
            @endif

            <!-- Formulario de registro -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Campo de nombre -->
                <div class="form-group">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required
                        autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo de email -->
                <div class="form-group">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required
                        placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                

                <!-- Campo de contraseña -->

                <!-- Campo de teléfono móvil -->
                <div class="form-group">
                    <input type="tel" name="mobilephone" class="form-control @error('mobilephone') is-invalid @enderror" required
                        placeholder="{{ trans('global.mobilephone') }} (e.g., +1234567890)" value="{{ old('mobilephone', null) }}">
                    @error('mobilephone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" required
                        placeholder="{{ trans('global.login_password') }}">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo de confirmación de contraseña -->
                <div class="form-group">
                    <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required
                        placeholder="{{ trans('global.login_password_confirmation') }}">
                </div>

                <!-- Checkbox para mostrar/ocultar contraseña -->
                <div class="form-group show-password">
                    <input type="checkbox" id="show-password">
                    <label for="show-password">{{ trans('global.show_password') }}</label>
                </div>

                <!-- Botón de registro -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ trans('global.register') }}
                    </button>
                </div>
            </form>

            <!-- Enlace a la página de inicio de sesión -->
            <p class="mb-0">
                <a href="{{ route('login') }}">
                    {{ trans('global.login') }}
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

    <!-- JavaScript para mostrar/ocultar las contraseñas -->
    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            var passwordConfirmInput = document.getElementById('password-confirm');
            if (this.checked) {
                passwordInput.type = 'text';
                passwordConfirmInput.type = 'text';
            } else {
                passwordInput.type = 'password';
                passwordConfirmInput.type = 'password';
            }
        });
    </script>
@endsection
