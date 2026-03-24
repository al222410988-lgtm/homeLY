<!DOCTYPE html>
<html>
<head>
<title>Crear Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-3">

<h5>Crear Administrador</h5>

<form method="POST" action="/admin/guardar">
@csrf

<input class="form-control mb-2" name="nombre">
<input class="form-control mb-2" name="email">
<input class="form-control mb-2" type="password" name="password">

<select class="form-control mb-2" name="categoria_admin">
<option value="areas_verdes">Áreas verdes</option>
<option value="calles">Calles</option>
<option value="fugas">Fugas</option>
<option value="alumbrado">Alumbrado</option>
</select>

<button class="btn btn-success w-100">Crear</button>
<a href="/dashboard" class="btn btn-secondary w-100 mt-2">Volver</a>

</form>

</div>

</body>
</html>