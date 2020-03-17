<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{

    protected $fillable = [
        'id',
        'nombre',       
    ];
    protected $table = "Curso";

    function someFunction()
        {
             return Curso::$table;
        }
}
