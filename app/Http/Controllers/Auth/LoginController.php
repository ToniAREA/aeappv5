<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\TwoFactorCodeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Exception;

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

        return null;
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
            ?: redirect()->to($this->redirectPath());
    }

    // ============================================
    // Google OAuth Login
    // ============================================
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(str_random(16)), // Genera una contraseña aleatoria
                    'avatar' => $googleUser->getAvatar(),
                ]
            );

            Auth::login($user);

            Log::info('User logged in with Google', ['user_id' => $user->id]);
            return redirect($this->redirectTo());
        } catch (Exception $e) {
            Log::error('Google login failed', ['error' => $e->getMessage()]);
            return redirect('/login')->withErrors(['msg' => 'Hubo un problema al iniciar sesión con Google']);
        }
    }

    // ============================================
    // Apple OAuth Login
    // ============================================
    public function redirectToApple()
    {
        $clientSecret = AppleClientSecret::generate();  // Asume que tienes un helper para generar el client_secret
        return Socialite::driver('apple')
            ->setScopes(['name', 'email'])
            ->setClientSecret($clientSecret)
            ->redirect();
    }

    public function handleAppleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $appleUser->getEmail()],
                [
                    'name' => $appleUser->getName(),
                    'apple_id' => $appleUser->getId(),
                    'password' => bcrypt(str_random(16)), // Genera una contraseña aleatoria
                    'avatar' => $appleUser->getAvatar(),
                ]
            );

            Auth::login($user);

            Log::info('User logged in with Apple', ['user_id' => $user->id]);
            return redirect($this->redirectTo());
        } catch (Exception $e) {
            Log::error('Apple login failed', ['error' => $e->getMessage()]);
            return redirect('/login')->withErrors(['msg' => 'Hubo un problema al iniciar sesión con Apple']);
        }
    }

    // ============================================
    // Facebook OAuth Login
    // ============================================
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $facebookUser->getEmail()],
                [
                    'name' => $facebookUser->getName(),
                    'facebook_id' => $facebookUser->getId(),
                    'password' => bcrypt(str_random(16)), // Genera una contraseña aleatoria
                    'avatar' => $facebookUser->getAvatar(),
                ]
            );

            Auth::login($user);

            Log::info('User logged in with Facebook', ['user_id' => $user->id]);
            return redirect($this->redirectTo());
        } catch (Exception $e) {
            Log::error('Facebook login failed', ['error' => $e->getMessage()]);
            return redirect('/login')->withErrors(['msg' => 'Hubo un problema al iniciar sesión con Facebook']);
        }
    }
}