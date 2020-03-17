<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $fillable = [
        'id',
        'nombre'       
    ];
    protected $table = "Asignatura";

    function someFunction()
    {
    	return Asignatura::$table;
    }
}
