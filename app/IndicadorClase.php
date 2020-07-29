<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicadorClase extends Model
{
    protected $fillable = [
        'id',
        'tipoIndicador',
        'puntuacion',
        'idInstanciaUnidad'
    ];
    protected $table = "IndicadorClase";
    public $timestamps = false;
}
