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

<?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="card mb-2 shadow-sm">
    <div class="card-body">

        <p><?php echo e($u->nombre); ?></p>
        <p><?php echo e($u->email); ?></p>

        <a href="/admin/aprobar/<?php echo e($u->id); ?>" class="btn btn-success btn-sm">
            Aprobar
        </a>

    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

</body>
</html><?php /**PATH C:\Users\52722\homeLY\resources\views/solicitudes.blade.php ENDPATH**/ ?>