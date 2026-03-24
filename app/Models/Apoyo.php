<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apoyo extends Model
{
    protected $table = 'apoyos';

    protected $fillable = [
        'usuario_id',
        'reporte_id'
    ];
}