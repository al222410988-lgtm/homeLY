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

<?php $__currentLoopData = $notificaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="card mb-2 shadow-sm">
    <div class="card-body">
        <p><?php echo e($n->mensaje); ?></p>
        <a href="/reporte/<?php echo e($n->reporte_id); ?>" class="btn btn-dark btn-sm">Ver detalle</a>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

</body>
</html><?php /**PATH C:\Users\52722\homeLY\resources\views/notificaciones.blade.php ENDPATH**/ ?>