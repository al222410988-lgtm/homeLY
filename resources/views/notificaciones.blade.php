<!DOCTYPE html>
<html>
<head>
<title>Notificaciones</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-3">

<h5>Notificaciones</h5>

<a href="/dashboard" class="btn btn-secondary w-100 mb-3">Volver</a>

@foreach($notificaciones as $n)
<div class="card mb-2 shadow-sm">
    <div class="card-body">
        <p>{{ $n->mensaje }}</p>
        <a href="/reporte/{{ $n->reporte_id }}" class="btn btn-dark btn-sm">Ver detalle</a>
    </div>
</div>
@endforeach

</div>

</body>
</html>