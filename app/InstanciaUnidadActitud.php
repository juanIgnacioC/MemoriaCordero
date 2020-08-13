<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaUnidadActitud extends Model
{
    protected $fillable = [
        'id',
        'NuevoNombre',
        'idInstanciaUnidad',
        'idActitudFK'
    ];
    protected $table = "InstanciaUnidadActitud";
    public $timestamps = false;

    public static function obtener($idUnidad)
	{
		$actitudes = InstanciaUnidadActitud::where('idInstanciaUnidad', $idUnidad)
        ->leftJoin('Actitud', 'Actitud.id', '=', 'InstanciaUnidadActitud.idActitudFK')
        ->select('InstanciaUnidadActitud.id','InstanciaUnidadActitud.NuevoNombre', 'InstanciaUnidadActitud.idInstanciaUnidad', 'InstanciaUnidadActitud.idActitudFK', 'Actitud.idObj')
	    ->get();

	    return $actitudes;
	}
}
