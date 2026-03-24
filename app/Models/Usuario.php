<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'categoria_admin'
    ];

    protected $hidden = [
        'password',
    ];
    public function reportes()
{
    return $this->belongsToMany(Reporte::class, 'reporte_usuarios');
}
public function apoyos()
{
    return $this->hasMany(Apoyo::class);
}
}