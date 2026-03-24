<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Vista para crear admin
   public function createAdmin()
{
    if (Auth::user()->rol != 'superadmin') {
        abort(403);
    }

    return view('crear_admin');
}

    // Guardar admin
    public function storeAdmin(Request $request)
{
    if (Auth::user()->rol != 'superadmin') {
        abort(403);
    }

    Usuario::create([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'rol' => 'admin',
        'categoria_admin' => $request->categoria_admin,
        'estado' => 'activo'
        ]);

    return redirect('/dashboard');
}
public function solicitudes()
{
    $usuarios = Usuario::where('estado', 'pendiente')->get();
    return view('solicitudes', compact('usuarios'));
}
public function aprobar($id)
{
    $user = Usuario::findOrFail($id);
    $user->estado = 'activo';
    $user->save();

    return redirect('/admin/solicitudes');
}
}