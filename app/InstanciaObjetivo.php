<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaObjetivo extends Model
{
    protected $fillable = [
        'id',
        'idObj',
        'NuevoNombre',
        'idSubEje'
    ];
    protected $table = "InstanciaObjetivo";
    public $timestamps = false;
}
