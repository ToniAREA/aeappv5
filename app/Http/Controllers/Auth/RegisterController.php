<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\RegistrationVerification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;


class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirect to home after registration
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('guest')->except('verifyEmail');
    }

    /**
     * Validator for registration request
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobilephone' => ['required', 'regex:/^\+\d{1,3}\d{9,15}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Handle the registration request
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate registration data
        $this->validator($request->all())->validate();

        // Generate verification token
        $token = Str::random(64);

        // Store user data temporarily in session (could be stored in cache or DB)
        session([
            'registration_data' => [
                'name' => $request->name,
                'email' => $request->email,
                'mobilephone' => $request->mobilephone,
                'password' => Hash::make($request->password),
                'token' => $token,
            ]
        ]);

        // Send verification email
        Mail::to($request->email)->send(new RegistrationVerification($token));
        Log::info('Verification email sent to ' . $request->email);

        // Redirect to a view that informs the user to check their email
        return view('auth.check-email')->with('status', 'We have sent you a verification link, please check your email.');
    }

    /**
     * Verify email after user clicks on the verification link
     *
     * @param  string  $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyEmail($token)
    {
        Log::info('Verifying email with token: ' . $token);
        $registrationData = session('registration_data');

        // Check if the token is valid
        if (!$registrationData || $registrationData['token'] !== $token) {
            return redirect()->route('register')->withErrors(['msg' => 'Invalid or expired verification token.']);
            Log::error('Invalid or expired verification token.');
        }else{
            Log::info('Token is valid. Proceeding with user creation.');
        }

        // Create and save the user in the DB
        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'mobilephone' => $registrationData['mobilephone'],
            'password' => $registrationData['password'],
            'email_verified_at' => Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format')),
            'verified' => 1,
        // other fields...
        ]);

        // Forget registration data from session
        session()->forget('registration_data');

        // Log the user in and redirect to the home page
        Auth::login($user);

        return redirect()->route('home')->with('status', 'Your email has been verified and your account has been created.');
    }

    /**
     * Redirect the user to Google's OAuth page for registration or login
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google's OAuth API
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user already exists in the DB
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(16)), // Generate a random password
                    'avatar' => $googleUser->getAvatar(),
                ]
            );

            Auth::login($user);

            return redirect()->route('home');
        } catch (Exception $e) {
            Log::error('Google login failed: ' . $e->getMessage());
            return redirect('/login')->withErrors(['msg' => 'Failed to login with Google.']);
        }
    }
}