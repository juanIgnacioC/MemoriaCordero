<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaIndicador extends Model
{
    protected $fillable = [
        'id',
        'nuevoNombre',
        'idInstanciaUnidadObjetivo'
    ];
    protected $table = "InstanciaIndicador";
    public $timestamps = false;
}
