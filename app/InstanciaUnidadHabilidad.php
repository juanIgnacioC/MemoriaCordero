<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaUnidadHabilidad extends Model
{
    protected $fillable = [
        'id',
        'NuevoNombre',
        'idInstanciaUnidad',
        'idHabilidadFK'
    ];
    protected $table = "InstanciaUnidadHabilidad";
    public $timestamps = false;

    public static function obtener($idUnidad)
	{
		$habilidades = InstanciaUnidadHabilidad::where('idInstanciaUnidad', $idUnidad)
	    ->get();

	    return $habilidades;
	}

}
