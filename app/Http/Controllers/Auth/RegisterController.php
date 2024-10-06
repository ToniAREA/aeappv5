<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('completeRegistration');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Complete the registration with additional information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function completeRegistration(Request $request)
    {
        // Validar los datos adicionales
        $request->validate([
            'mobilephone' => 'required|regex:/^\+\d{1,3}\d{9,15}$/',
            'role' => 'required|in:client,provider,employee', // Solo permite los roles especificados
            'comments' => 'nullable|string|max:1000',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->withErrors(['msg' => 'Por favor, inicia sesión para completar tu registro.']);
        }

        // Actualizar los datos del usuario
        $user->mobilephone = $request->mobilephone;
        $user->role = $request->role;
        $user->comments = $request->comments;
        $user->save();

        return redirect()->route('home')->with('status', 'Registration complete!');
    }
}