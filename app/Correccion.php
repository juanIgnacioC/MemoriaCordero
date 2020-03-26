<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correccion extends Model
{
    protected $fillable = [
        'id',
        'idInstanciaUnidad',
        'asignatura',
        'curso',
        'anio',
        'correcciones',
        'estado',
        'idUsuario'
    ];
    protected $table = "Correccion";
    public $timestamps = false;

}
