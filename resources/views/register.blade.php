<!DOCTYPE html>
<html>
<head>
<title>Registro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background:#f1f3f6; }
.card { border-radius:20px; }
</style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card p-4 shadow" style="width:350px;">
    <h4 class="text-center mb-3">Crear cuenta</h4>

    <form method="POST" action="/register">
        @csrf

        <input class="form-control mb-2" name="nombre" placeholder="Nombre">
        <input class="form-control mb-2" name="email" placeholder="Correo">
        <input class="form-control mb-2" type="password" name="password" placeholder="Contraseña">

        <button class="btn btn-success w-100">Registrarse</button>
    </form>

    <a href="/login" class="text-center mt-3">Volver al login</a>
</div>

</body>
</html>