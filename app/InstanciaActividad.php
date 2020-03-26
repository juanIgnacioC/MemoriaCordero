<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaActividad extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'idInstanciaUnidadObjetivo'
    ];
    protected $table = "InstanciaActividad";
    public $timestamps = false;
}
