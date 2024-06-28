<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCodeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        Log::info('Redirecting user', ['user_id' => auth()->user()->id]);

        if (auth()->user()->is_admin) {
            Log::info('User is admin, redirecting to /admin');
            return '/admin';
        }

        Log::info('User is not admin, redirecting to /home');
        return '/home';
    }

    protected function authenticated(Request $request, $user)
    {
        Log::info('User authenticated successfully', ['user_id' => $user->id]);

        if ($user->two_factor) {
            Log::info('Two factor authentication enabled, generating code and notifying user', ['user_id' => $user->id]);

            $user->generateTwoFactorCode();
            $user->notify(new TwoFactorCodeNotification());

            return redirect()->route('two-factor');
        }
    }

    public function login(Request $request)
    {
        Log::info('Login attempt started', ['request' => $request->all()]);

        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            Log::info('Login successful');
            return $this->sendLoginResponse($request);
        }

        Log::info('Login failed');
        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        Log::info('Redirecting after login', ['url' => $this->redirectPath()]);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }
}
