<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanificacionUnidad extends Model
{
    protected $fillable = [
        'id',
        'Periodo',
        'idInstanciaPlaniAño',
        'idRepositorio',
        'fechaInicio',
        'fechaTermino'
    ];
    protected $table = "PlanificacionUnidad";
    public $timestamps = false;
}
