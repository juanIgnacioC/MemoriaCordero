<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciasConocimientoPrevio extends Model
{
    protected $fillable = [
        'id',
        'nuevoNombre',
        'idInstanciaUnidadObjetivo'
    ];
    protected $table = "InstanciasConocimientoPrevio";
    public $timestamps = false;
}
