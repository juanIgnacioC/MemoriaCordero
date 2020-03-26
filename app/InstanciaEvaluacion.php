<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaEvaluacion extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'idInstanciaUnidadObjetivo'
    ];
    protected $table = "InstanciaEvaluacion";
    public $timestamps = false;
}
