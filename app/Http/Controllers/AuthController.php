<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('login');
    }
public function login(Request $request)
{
    $user = \App\Models\Usuario::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'Usuario no existe');
    }

    if ($user->estado != 'activo') {
        return back()->with('error', 'Usuario pendiente de aprobación');
    }

    if (!\Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Password incorrecto');
    }

    \Auth::login($user);

    return redirect('/dashboard');
}

    public function showRegister() {
        return view('register');
    }

public function register(Request $request) {
    \App\Models\Usuario::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'password' => \Hash::make($request->password),
        'rol' => 'residente',
        'estado' => 'pendiente' // 🔥 CLAVE
    ]);

    return redirect('/login')->with('success', 'Registro enviado, espera aprobación');
}

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
