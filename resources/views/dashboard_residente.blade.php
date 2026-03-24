<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background:#f5f6fa; }
.card { border-radius:15px; }
</style>
</head>

<body>
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="container mt-3">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Mis reportes</h5>

    <form method="POST" action="/logout">
        @csrf
        <button class="btn btn-danger btn-sm">Salir</button>
    </form>
</div>

<a href="/reporte/crear" class="btn btn-primary w-100 mb-3">+ Crear reporte</a>
<a href="/notificaciones" class="btn btn-warning w-100 mb-3">Ver notificaciones</a>

@foreach($reportes as $r)
<p><strong>Reportado por:</strong> {{ $r->usuario->nombre }}</p>

@php
$yaApoyo = $r->apoyos->where('usuario_id', auth()->id())->count();
@endphp

<p>Apoyos: {{ $r->apoyos->count() }}</p>

@if($r->usuario_id != auth()->id())

    @if($yaApoyo == 0)
        <a href="/reporte/apoyar/{{ $r->id }}" class="btn btn-warning btn-sm">
            🚨 Apoyar
        </a>
    @else
        <button class="btn btn-secondary btn-sm" disabled>
            Ya apoyado
        </button>
    @endif

@else
    <button class="btn btn-secondary btn-sm" disabled>
        Tu reporte
    </button>
@endif
</a>
<div class="card mb-2 shadow-sm">
    <div class="card-body">

        <h6>{{ $r->categoria }}</h6>

        <span class="badge bg-info">{{ $r->estado }}</span>

        <div class="mt-2 d-flex justify-content-between">
            <a href="/reporte/{{ $r->id }}" class="btn btn-dark btn-sm">Ver</a>

            <a href="/reporte/eliminar/{{ $r->id }}" 
               class="btn btn-danger btn-sm"
               onclick="return confirm('¿Eliminar?')">
               Eliminar
            </a>
        </div>

    </div>
</div>
@endforeach

</div>

</body>
</html>