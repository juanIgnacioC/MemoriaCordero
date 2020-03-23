<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadHabilidad extends Model
{
    protected $fillable = [
        'id',
        'idUnidad',
        'idHabilidad'
    ];
    protected $table = "UnidadHabilidad";
    public $timestamps = false;


    public static function obtenerHabilidades($idUnidad, $idRepositorio)
	{
		//si existe una referencia a unidad
		if($idUnidad != null){
			dump("existe referencia unidad");

			$habilidades = UnidadHabilidad::where('idUnidad', $idUnidad)
		    ->leftJoin('Habilidad', 'Habilidad.id', '=', 'UnidadHabilidad.idHabilidad')
		    ->select('Habilidad.nombre','Habilidad.id as idHabilidadFK')
		    ->get();

		    return $habilidades;

		}elseif($idRepositorio != null) {
			dump("No existe referencia unidad");

			$habilidades = Unidad::where('idRepositorio', $idRepositorio)
			->leftJoin('UnidadHabilidad', 'UnidadHabilidad.idUnidad', '=', 'Unidad.id')
			->leftJoin('Habilidad', 'Habilidad.id', '=', 'UnidadHabilidad.idHabilidad')
			->select('Habilidad.nombre','Habilidad.id as idHabilidadFK')
			->groupBy('idHabilidadFK')
        	->get();

        	return $habilidades;

		}
		return "";

	}
}
