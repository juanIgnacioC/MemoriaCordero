<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'idSubEje'
    ];
    protected $table = "Objetivo";
    public $timestamps = false;
}
