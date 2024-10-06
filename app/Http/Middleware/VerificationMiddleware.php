<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VerificationMiddleware
{
    public function handle($request, Closure $next)
{
    if (Auth::check()) {
        $user = Auth::user();

        if (!$user->verified) {
            $cacheKey = 'verification_email_sent_at_user_' . $user->id;
            $lastSent = Cache::get($cacheKey);

            if ($lastSent && $lastSent->gt(now()->subMinutes(5))) {
                Auth::logout();

                return redirect()->route('login')->with('message', 'Tu cuenta no está verificada. Por favor, revisa tu email.');
            }

            // Almacenar el timestamp actual en la caché por 5 minutos
            Cache::put($cacheKey, now(), 5);

            // Enviar el email de verificación
            //$user->notify(new \App\Notifications\VerifyUserNotification($user));

            Auth::logout();

            return redirect()->route('login')->with('message', 'Tu cuenta no está verificada. Hemos reenviado el correo de verificación a tu email.');
        }
    }

    return $next($request);
}
}