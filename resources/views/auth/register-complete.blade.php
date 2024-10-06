@extends('layouts.app')

@section('content')
    <div class="login-container">
        <div class="login-box">
            @include('partials.logo')

            <p class="login-box-msg">
                {{ __('Complete your Registration') }}
            </p>

            <!-- Formulario para completar el registro -->
            <form method="POST" action="{{ route('register.complete') }}">
                @csrf

                <!-- Campo de teléfono móvil -->
                <div class="form-group">
                    <label for="mobilephone" class="form-label">{{ trans('global.mobilephone') }}</label>
                    <div class="input-group">
                        <span class="input-group-text">+</span>
                        <input type="tel" id="mobilephone" name="mobilephone"
                            class="form-control @error('mobilephone') is-invalid @enderror" required
                            placeholder="1234567890" pattern="[0-9]{7,15}" minlength="7" maxlength="15"
                            aria-describedby="mobilephoneHelp" value="{{ old('mobilephone', null) }}">
                    </div>
                    @error('mobilephone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small id="mobilephoneHelp" class="form-text text-muted">
                        {{ trans('global.phone_validation_notice') }}
                    </small>
                </div>

                <!-- Selector de rol con opciones actualizadas -->
                <div class="form-group">
                    <label for="role">{{ __('Select Role') }}</label>
                    <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                        <option value="">{{ __('Choose your role') }}</option>
                        <option value="client">{{ __('Client') }}</option>
                        <option value="provider">{{ __('Provider') }}</option>
                        <option value="employee">{{ __('Employee') }}</option>
                    </select>

                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Comentarios -->
                <div class="form-group">
                    <label for="comments">{{ __('Comments') }}</label>
                    <textarea id="comments" name="comments" class="form-control @error('comments') is-invalid @enderror" rows="4" placeholder="Describe your role or additional information"></textarea>

                    @error('comments')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Botón de completar registro -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Complete Registration') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection