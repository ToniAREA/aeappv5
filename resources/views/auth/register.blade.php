@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="login-box">

            <!-- Logo or title -->
            @include('partials.logo')

            <!-- Alert messages -->
            @if (session()->has('message'))
                <div class="alert alert-info">
                    {{ session()->get('message') }}
                </div>
            @endif

            <!-- Registration form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name field -->
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                    <div class="invalid-feedback" id="name-error" style="display: none;">
                        {{ __('Please enter your full name (first and last name).') }}
                    </div>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email field -->
                <div class="form-group">
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" required
                        placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                    <div class="invalid-feedback" id="email-error" style="display: none;">
                        {{ __('Please enter a valid email address.') }}
                    </div>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Mobile phone field -->
                <div class="form-group">
                    <input type="tel" name="mobilephone" class="form-control @error('mobilephone') is-invalid @enderror"
                        required placeholder="{{ trans('global.mobilephone') }} (e.g., +1234567890)"
                        value="{{ old('mobilephone', null) }}">
                    @error('mobilephone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password field -->
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

                <!-- Password confirmation field -->
                <div class="form-group">
                    <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required
                        placeholder="{{ trans('global.login_password_confirmation') }}">
                    <div class="invalid-feedback" id="password-error" style="display: none;">
                        {{ __('Passwords do not match.') }}
                    </div>
                </div>

                <!-- Checkbox to show/hide password -->
                <div class="form-group show-password">
                    <input type="checkbox" id="show-password">
                    <label for="show-password">{{ trans('global.show_password') }}</label>
                </div>

                <!-- Register button with loader -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" id="register-btn">
                        {{ trans('global.register') }}
                    </button>
                    <div id="loading-spinner" style="display:none;">
                        <img src="{{ asset('spinner.gif') }}" alt="Loading..." />
                    </div>
                </div>

                <script>
                    document.querySelector('form').addEventListener('submit', function(event) {
                        // Final validation before submitting the form
                        if (!validateForm()) {
                            event.preventDefault();
                        } else {
                            document.getElementById('register-btn').disabled = true;
                            document.getElementById('loading-spinner').style.display = 'block';
                        }
                    });

                    // Function to validate the entire form
                    function validateForm() {
                        let isValid = true;

                        // Validate name
                        const nameInput = document.getElementById('name');
                        const nameError = document.getElementById('name-error');
                        if (!validateName(nameInput.value)) {
                            nameError.style.display = 'block';
                            nameInput.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            nameError.style.display = 'none';
                            nameInput.classList.remove('is-invalid');
                        }

                        // Validate email
                        const emailInput = document.getElementById('email');
                        const emailError = document.getElementById('email-error');
                        if (!validateEmail(emailInput.value)) {
                            emailError.style.display = 'block';
                            emailInput.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            emailError.style.display = 'none';
                            emailInput.classList.remove('is-invalid');
                        }

                        // Validate passwords
                        const passwordInput = document.getElementById('password');
                        const passwordConfirmInput = document.getElementById('password-confirm');
                        const passwordError = document.getElementById('password-error');
                        if (passwordInput.value !== passwordConfirmInput.value) {
                            passwordError.style.display = 'block';
                            passwordConfirmInput.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            passwordError.style.display = 'none';
                            passwordConfirmInput.classList.remove('is-invalid');
                        }

                        return isValid;
                    }

                    // Real-time validation for name
                    document.getElementById('name').addEventListener('input', function() {
                        const nameInput = this;
                        const nameError = document.getElementById('name-error');
                        if (!validateName(nameInput.value)) {
                            nameError.style.display = 'block';
                            nameInput.classList.add('is-invalid');
                        } else {
                            nameError.style.display = 'none';
                            nameInput.classList.remove('is-invalid');
                        }
                    });

                    // Real-time validation for email
                    document.getElementById('email').addEventListener('input', function() {
                        const emailInput = this;
                        const emailError = document.getElementById('email-error');
                        if (!validateEmail(emailInput.value)) {
                            emailError.style.display = 'block';
                            emailInput.classList.add('is-invalid');
                        } else {
                            emailError.style.display = 'none';
                            emailInput.classList.remove('is-invalid');
                        }
                    });

                    // Real-time validation for passwords
                    document.getElementById('password-confirm').addEventListener('input', function() {
                        const passwordInput = document.getElementById('password');
                        const passwordConfirmInput = this;
                        const passwordError = document.getElementById('password-error');
                        if (passwordInput.value !== passwordConfirmInput.value) {
                            passwordError.style.display = 'block';
                            passwordConfirmInput.classList.add('is-invalid');
                        } else {
                            passwordError.style.display = 'none';
                            passwordConfirmInput.classList.remove('is-invalid');
                        }
                    });

                    // Function to validate full name
                    function validateName(name) {
                        const nameParts = name.trim().split(' ');
                        return nameParts.length >= 2;
                    }

                    // Function to validate email
                    function validateEmail(email) {
                        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        return re.test(String(email).toLowerCase());
                    }

                    // JavaScript to show/hide passwords
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
            </form>

            <!-- Link to login page -->
            <p class="mb-0">
                <a href="{{ route('login') }}">
                    {{ trans('global.login') }}
                </a>
            </p>
            <p class="text-center">
                -- Or login with --
            </p>

            <!-- Google login button -->
            <div class="text-center">
                <a href="{{ url('auth/google') }}" class="btn btn-primary text-white btn-block mb-2">
                    <i class="fab fa-google"></i> {{ __('Google') }}
                </a>
            </div>
        </div>
    </div>
@endsection
