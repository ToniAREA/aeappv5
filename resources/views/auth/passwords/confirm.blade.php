@extends('layouts.app')

@section('content')

<div class="login-container">
    <div class="login-box">
        @include('partials.logo')

        <!-- Información del usuario -->
        <div class="user-info text-center">
            <!-- Avatar o iniciales del usuario -->
            <div class="user-avatar">
                <div class="avatar-initials">
                    @if(auth()->user()->name)
                        {{ substr(auth()->user()->name, 0, 2) }}
                    @endif
                </div>
            </div>
            <!-- Nombre del usuario -->
            <div class="user-name">
                {{ auth()->user()->name ?? '' }}
            </div>
        </div>

        <!-- Mensaje -->
        <p class="login-box-msg">
            {{ __('Please confirm your password before continuing.') }}
        </p>

        <!-- Mensaje de error -->
        @error('password')
            <div class="alert alert-danger text-center">
                {{ $message }}
            </div>
        @enderror

        <!-- Formulario -->
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Campo de contraseña -->
            <div class="form-group">
                <input id="password" type="password" name="password" class="form-control" placeholder="{{ __('Confirm Password') }}" required>
            </div>

            <!-- Checkbox para mostrar/ocultar contraseña -->
            <div class="form-group show-password">
                <input type="checkbox" id="show-password">
                <label for="show-password">{{ trans('global.show_password') }}</label>
            </div>

            <!-- Botón de confirmación -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Confirm Password') }}
                </button>
            </div>
        </form>

        <!-- Enlace a "Olvidé mi contraseña" -->
        <p class="mb-0 text-center">
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ trans('global.forgot_password') }}
                </a>
            @endif
        </p>
    </div>
</div>

<!-- JavaScript para mostrar/ocultar​⬤