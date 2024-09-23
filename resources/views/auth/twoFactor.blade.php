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

            <!-- Mensaje de la página -->
            <p class="login-box-msg">
                {{ __('global.two_factor.title') }}
            </p>

            <!-- Mensajes de alerta -->
            @if(session()->has('message'))
                <div class="alert alert-info">
                    {{ session()->get('message') }}
                </div>
            @endif

            <!-- Mensaje secundario -->
            <p class="text-muted text-center">
                {{ __('global.two_factor.sub_title', ['minutes' => 15]) }}
            </p>

            <!-- Formulario -->
            <form method="POST" action="{{ route('twoFactor.check') }}">
                @csrf

                <!-- Campo de código de autenticación -->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <input name="two_factor_code" type="text" class="form-control @error('two_factor_code') is-invalid @enderror" required autofocus placeholder="{{ trans('global.two_factor.code') }}">
                        @error('two_factor_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Botón de verificación -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ trans('global.two_factor.verify') }}
                    </button>
                </div>

                <!-- Enlaces adicionales -->
                <div class="form-group text-center">
                    <a class="btn btn-secondary" href="{{ route('twoFactor.resend') }}">
                        {{ __('global.two_factor.resend') }}
                    </a>
                    <a class="btn btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        {{ trans('global.logout') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection