<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataRetroalimentacionesCurso extends Model
{
    /*protected $id = '';
    protected $nombreObjetivo = '';
    protected $conocimientos = '';
    protected $actividades = '';
    protected $indicadores = '';
    protected $idInstanciaUnidad = '';

    public $timestamps = false;
    protected $attributes = [
        'id' => '',
        'nombreObjetivo' => '',
        'conocimientos' => '',
        'actividades' => '',
        'indicadores' => '',
        'idInstanciaUnidad' => ''
    ];*/
    protected $fillable = [
        'id',
        'unidad',
        'clases'
    ];
}
