<!DOCTYPE html>
<html>
<head>
<title>Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background:#eef2f7; }
.card { border-radius:15px; }
</style>
</head>

<body>

<div class="container mt-3">

<div class="d-flex justify-content-between mb-3">
    <h5>Panel Admin</h5>

    <form method="POST" action="/logout">
        @csrf
        <button class="btn btn-danger btn-sm">Salir</button>
    </form>
</div>

@if(Auth::user()->rol == 'superadmin')
    <a href="/admin/crear" class="btn btn-success w-100 mb-2">Crear Admin</a>
    <a href="/admin/solicitudes" class="btn btn-warning w-100 mb-3">Solicitudes</a>
@endif

@foreach($reportes as $r)

@php

$apoyos = $r->apoyos->count();

if($apoyos < 4){
    $nivel = "No urgente";
    $color = "secondary";
}elseif($apoyos <= 8){
    $nivel = "Urgente";
    $color = "warning";
}else{
    $nivel = "Muy urgente";
    $color = "danger";
}
@endphp
<p><strong>Reportado por:</strong> {{ $r->usuario->nombre }}</p>

<p>Apoyos: {{ $apoyos }}</p>

<span class="badge bg-{{ $color }}">
    {{ $nivel }}
</span>
<div class="card mb-2 shadow-sm">
    <div class="card-body">

        <h6>{{ $r->categoria }}</h6>
        <span class="badge bg-info">{{ $r->estado }}</span>

        <div class="mt-2">
            <a href="/reporte/{{ $r->id }}" class="btn btn-dark btn-sm">Ver</a>
        </div>

    </div>
</div>
@endforeach

</div>

</body>
</html>