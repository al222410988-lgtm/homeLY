<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;
use App\Models\Apoyo;

class ReporteController extends Controller
{
    // Mostrar dashboard según rol
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->rol == 'residente') {
$reportes = Reporte::with('usuario')->latest()->get();
            return view('dashboard_residente', compact('reportes'));
        }

        if ($user->rol == 'admin') {
            $reportes = Reporte::with(['usuario','apoyos'])->latest()->get();
            return view('dashboard_admin', compact('reportes'));
        }

        if ($user->rol == 'superadmin') {
            $reportes = Reporte::all();
            return view('dashboard_admin', compact('reportes'));
        }
    }

    // Formulario crear reporte
    public function create()
    {
        return view('crear_reporte');
    }

    // Guardar reporte
public function store(Request $request)
{
    $request->validate([
        'categoria' => 'required',
        'descripcion' => 'required',
        'latitud' => 'required',
        'longitud' => 'required'
    ]);

    // 🔍 Buscar si ya existe reporte similar
    $reporteExistente = Reporte::where('categoria', $request->categoria)
        ->where('latitud', $request->latitud)
        ->where('longitud', $request->longitud)
        ->first();

    if ($reporteExistente) {

        // 👉 Agregar usuario al reporte existente
        $reporteExistente->usuarios()->syncWithoutDetaching([Auth::id()]);

        return redirect('/dashboard')->with('info', 'Ya existe este reporte, te uniste a él');
    }

    // 📸 Imagen
    $imagen = null;
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen')->store('reportes', 'public');
    }

    // 🆕 Crear nuevo reporte
    $reporte = Reporte::create([
        'usuario_id' => Auth::id(),
        'categoria' => $request->categoria,
        'descripcion' => $request->descripcion,
        'imagen_problema' => $imagen,
        'latitud' => $request->latitud,
        'longitud' => $request->longitud,
        'direccion' => $request->direccion,
    ]);

    // 👉 Asociar usuario
    $reporte->usuarios()->attach(Auth::id());

    return redirect('/dashboard');
}
    // Ver detalle
    public function show($id)
    {
$reporte = Reporte::with(['usuario','usuariosApoyo','apoyos'])->findOrFail($id);        return view('detalle_reporte', compact('reporte'));
    }
 public function actualizar(Request $request, $id)
{
    $reporte = Reporte::findOrFail($id);

    // Guardar admin que atiende
    $reporte->admin_id = auth()->id();

    // Estado
    $reporte->estado = $request->estado;

    // Mensaje
    $reporte->mensaje_admin = $request->mensaje_admin;

    // Imagen solución
    if ($request->hasFile('imagen_solucion')) {
        $ruta = $request->file('imagen_solucion')->store('soluciones', 'public');
        $reporte->imagen_solucion = $ruta;
    }

    // Fecha final
    if ($request->estado == 'finalizado') {
        $reporte->fecha_finalizacion = now();
    }

    $reporte->save();

    // NOTIFICACIÓN
    if ($request->mensaje_admin) {
        \App\Models\Notificacion::create([
            'usuario_id' => $reporte->usuario_id,
            'reporte_id' => $reporte->id,
            'mensaje' => $request->mensaje_admin
        ]);
    }

    return back()->with('success', 'Reporte actualizado');
}
public function eliminar($id)
{
    $reporte = Reporte::findOrFail($id);

    // 🔒 Solo el dueño puede eliminar
    if ($reporte->usuario_id != Auth::id()) {
        abort(403);
    }

    $reporte->delete();

    return redirect('/dashboard')->with('success', 'Reporte eliminado');
}


public function apoyar($id)
{
    $reporte = Reporte::findOrFail($id);

    // ❌ No puede apoyar su propio reporte
    if ($reporte->usuario_id == auth()->id()) {
        return back()->with('error', 'No puedes apoyar tu propio reporte');
    }

    // ❌ Ya apoyó antes
    $existe = \App\Models\Apoyo::where('usuario_id', auth()->id())
        ->where('reporte_id', $id)
        ->exists();

    if ($existe) {
        return back()->with('error', 'Ya apoyaste este reporte');
    }

    // ✅ Guardar apoyo
    \App\Models\Apoyo::create([
        'usuario_id' => auth()->id(),
        'reporte_id' => $id
    ]);

    // 🔔 Notificar admin
    if ($reporte->admin_id) {
        \App\Models\Notificacion::create([
            'usuario_id' => $reporte->admin_id,
            'reporte_id' => $id,
            'mensaje' => 'Un usuario marcó este reporte como urgente'
        ]);
    }

    return back()->with('success', 'Apoyo registrado');
}
}