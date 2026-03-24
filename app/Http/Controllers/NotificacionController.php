<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::where('usuario_id', Auth::id())->latest()->get();

        return view('notificaciones', compact('notificaciones'));
    }
}