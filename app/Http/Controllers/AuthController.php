<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Llave única combinando el correo y la IP del usuario
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        // 1. Verificar si ya superó los 5 intentos permitidos
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $segundos = RateLimiter::availableIn($throttleKey);
            
            return back()->withErrors([
                'email' => "Demasiados intentos fallidos. Acceso bloqueado por seguridad. Intenta nuevamente en {$segundos} segundos."
            ])->onlyInput('email');
        }

        // 2. Intentar autenticar
        if (Auth::attempt($credenciales, $request->boolean('remember'))) {
            // Éxito: Limpiamos los intentos fallidos anteriores
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            
            return redirect()->intended(route('gestion.index'));
        }

        // 3. Falló: Contabilizamos 1 intento fallido (penalización de 60 segundos)
        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrectos.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }

    public function mostrarCambiarPassword()
    {
        return view('auth.cambiar-password');
    }

    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'], // Exige la clave actual del admin
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()], // Exige la nueva clave segura
        ], [
            'current_password.current_password' => 'La contraseña actual no es correcta.',
            'password.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
        ]);

        $request->user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return back()->with('success_password', '¡Contraseña actualizada con éxito!');
    }
}