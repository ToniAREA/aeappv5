@component('mail::message')
# Verify Your Email

Please click the button below to verify your email and complete your registration.

@component('mail::button', ['url' => route('register.verify', $token)])
Verify Email
@endcomponent

If you did not sign up, no further action is required.

Thanks,  
{{ config('app.name') }}
@endcomponent