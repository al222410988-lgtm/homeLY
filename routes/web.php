<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificacionController;

Route::get('/notificaciones', [NotificacionController::class, 'index'])->middleware('auth');

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout']);

// RUTAS PROTEGIDAS
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [ReporteController::class, 'dashboard']);

    Route::get('/reporte/crear', [ReporteController::class, 'create']);
    Route::post('/reporte/guardar', [ReporteController::class, 'store']);

    Route::get('/reporte/{id}', [ReporteController::class, 'show']);
Route::post('/reporte/actualizar/{id}', [ReporteController::class, 'actualizar'])->middleware('auth');
});

Route::middleware('auth')->group(function () {

    Route::get('/admin/crear', [AdminController::class, 'createAdmin']);
    Route::post('/admin/guardar', [AdminController::class, 'storeAdmin']);
    Route::get('/admin/solicitudes', [AdminController::class, 'solicitudes'])->middleware('auth');
Route::get('/admin/aprobar/{id}', [AdminController::class, 'aprobar'])->middleware('auth');
Route::get('/reporte/eliminar/{id}', [ReporteController::class, 'eliminar'])->middleware('auth');
Route::get('/reporte/apoyar/{id}', [ReporteController::class, 'apoyar'])->middleware('auth');
});