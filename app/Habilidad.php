<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    protected $fillable = [
        'id',
        'nombre'
    ];
    protected $table = "Habilidad";
    public $timestamps = false;
}
