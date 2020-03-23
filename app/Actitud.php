<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actitud extends Model
{
    protected $fillable = [
        'id',
        'nombre'
    ];
    protected $table = "Actitud";
    public $timestamps = false;
}
