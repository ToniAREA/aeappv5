@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="login-box">
            @include('partials.logo')

            <!-- Mensaje de restablecimiento de contraseña -->
            <p class="login-box-msg">
                {{ trans('global.reset_password') }}
            </p>

            <!-- Mensajes de alerta -->
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Formulario de restablecimiento de contraseña -->
            <form method="POST" action="{{ route('password.request') }}">
                @csrf

                <input name="token" value="{{ $token }}" type="hidden">

                <!-- Campo de email -->
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                        placeholder="{{ trans('global.login_email') }}">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo de contraseña -->
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required placeholder="{{ trans('global.login_password') }}">

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Campo de confirmación de contraseña -->
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        placeholder="{{ trans('global.login_password_confirmation') }}">
                </div>

                <!-- Checkbox para mostrar/ocultar contraseñas -->
                <div class="form-group show-password">
                    <input type="checkbox" id="show-password">
                    <label for="show-password">{{ trans('global.show_password') }}</label>
                </div>

                <!-- Botón de restablecimiento -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ trans('global.reset_password') }}
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
