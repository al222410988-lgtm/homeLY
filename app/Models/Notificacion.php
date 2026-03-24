<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';
    protected $fillable = [
        'usuario_id',
        'reporte_id',
        'mensaje',
        'leido'
    ];
    
}