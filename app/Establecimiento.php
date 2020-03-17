<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'isSemestral'       
    ];
    protected $table = "Establecimiento";
}
