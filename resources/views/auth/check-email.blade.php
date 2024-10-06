@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="login-box">
            @include('partials.logo')

            <h3>{{ __('Check your email') }}</h3>
            <p>{{ __('We have sent you a verification link. Please check your email to complete your registration.') }}
            </p>

            <p>{{ __('If you did not receive the email') }}, <a
                    {{-- href="{{ route('verification.resend', ['email' => request('email')]) }}">{{ __('click here to request another') }}</a>.</p>
 --}}
        </div>
    </div>
@endsection
