<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: linear-gradient(135deg,#4facfe,#00f2fe); }
.card { border-radius:20px; }
</style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card p-4 shadow" style="width:350px;">
    <h3 class="text-center mb-3">homeLY</h3>

    <form method="POST" action="/login">
        <?php echo csrf_field(); ?>

        <input class="form-control mb-2" name="email" placeholder="Correo">
        <input class="form-control mb-2" type="password" name="password" placeholder="Contraseña">

        <button class="btn btn-dark w-100">Entrar</button>
    </form>

    <a href="/register" class="text-center mt-3">Registrarse</a>

    <?php if(session('error')): ?>
        <div class="alert alert-danger mt-2"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
</div>

</body>
</html><?php /**PATH C:\Users\52722\homeLY\resources\views/login.blade.php ENDPATH**/ ?>