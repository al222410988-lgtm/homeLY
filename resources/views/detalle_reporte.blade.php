<!DOCTYPE html>
<html>
<head>
<title>Detalle</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<style>
#map { height:250px; border-radius:15px; }
</style>

</head>

<body class="bg-light">

<div class="container mt-3">

<a href="/dashboard" class="btn btn-secondary mb-2">← Volver</a>

<div class="card p-3 shadow">

<h5>{{ $reporte->categoria }}</h5>
<span class="badge bg-info">{{ $reporte->estado }}</span>

<p class="mt-2">{{ $reporte->descripcion }}</p>

<p><strong>Ubicación:</strong> {{ $reporte->direccion }}</p>

<p><strong>Reportado por:</strong> {{ $reporte->usuario->nombre }}</p>



@if($reporte->admin)
<p><strong>Atendido por:</strong> {{ $reporte->admin->nombre }}</p>
@endif

<h6 class="mt-3">Personas que apoyan:</h6>

@foreach($reporte->usuariosApoyo as $u)
    <span class="badge bg-warning text-dark">{{ $u->nombre }}</span>
@endforeach

@if($reporte->imagen_problema)
<img src="/storage/{{ $reporte->imagen_problema }}" class="img-fluid mt-2">
@endif

@if($reporte->imagen_solucion)
<h6 class="mt-3">Solución:</h6>
<img src="/storage/{{ $reporte->imagen_solucion }}" class="img-fluid">
@endif

<div id="map"></div>

</div>

<!-- 🔥 PANEL ADMIN -->
@auth
@if(Auth::user()->rol == 'admin' || Auth::user()->rol == 'superadmin')

<div class="card p-3 mt-3 shadow">

<h5>Actualizar Reporte</h5>

<form method="POST" action="/reporte/actualizar/{{ $reporte->id }}" enctype="multipart/form-data">
@csrf

<select class="form-control mb-2" name="estado">
<option value="pendiente">Pendiente</option>
<option value="en_proceso">En proceso</option>
<option value="finalizado">Finalizado</option>
</select>

<textarea class="form-control mb-2" name="mensaje_admin" placeholder="Mensaje al usuario"></textarea>

<input class="form-control mb-2" type="file" name="imagen_solucion">

<button class="btn btn-primary w-100">Actualizar</button>
</form>

</div>

@endif
@endauth

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
var map=L.map('map').setView([{{ $reporte->latitud }},{{ $reporte->longitud }}],15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

L.marker([{{ $reporte->latitud }},{{ $reporte->longitud }}]).addTo(map);
</script>

</body>
</html>