<!DOCTYPE html>
<html>
<head>
<title>Solicitudes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-3">

<h5>Solicitudes</h5>

<a href="/dashboard" class="btn btn-secondary w-100 mb-3">Volver</a>

@foreach($usuarios as $u)
<div class="card mb-2 shadow-sm">
    <div class="card-body">

        <p>{{ $u->nombre }}</p>
        <p>{{ $u->email }}</p>

        <a href="/admin/aprobar/{{ $u->id }}" class="btn btn-success btn-sm">
            Aprobar
        </a>

    </div>
</div>
@endforeach

</div>

</body>
</html>