<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepositorioPlanificacion extends Model
{
    protected $fillable = [
        'id',
        'idCurso',
        'idAsignatura'
    ];
    protected $table = "RepositorioPlanificacion";
    public $timestamps = false;

}
