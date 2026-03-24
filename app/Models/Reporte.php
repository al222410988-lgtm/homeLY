<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
protected $fillable = [
    'usuario_id',
    'categoria',
    'descripcion',
    'imagen_problema',
    'imagen_solucion',
    'latitud',
    'longitud',
    'estado',
    'mensaje_admin',
    'fecha_finalizacion',
    'direccion',
    'estado',
    'mensaje_admin',
    'imagen_solucion',
    'admin_id'
];

public function usuario()
{
    return $this->belongsTo(Usuario::class);
}
public function usuarios()
{
    return $this->belongsToMany(Usuario::class, 'reporte_usuarios');
}
public function admin()
{
    return $this->belongsTo(Usuario::class, 'admin_id');
}

public function apoyos()
{
    return $this->hasMany(\App\Models\Apoyo::class);
}
public function usuariosApoyo()
{
    return $this->belongsToMany(
        \App\Models\Usuario::class,
        'apoyos',
        'reporte_id',
        'usuario_id'
    );
}
}
