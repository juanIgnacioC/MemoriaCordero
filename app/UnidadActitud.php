<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadActitud extends Model
{
    protected $fillable = [
        'id',
        'idUnidad',
        'idActitud'
    ];
    protected $table = "UnidadActitud";
    public $timestamps = false;

    public static function obtenerActitudes($idUnidad, $idRepositorio)
	{
		//si existe una referencia a unidad
		if($idUnidad != null){
			//dump("existe referencia unidad");

			$actitudes = UnidadActitud::where('idUnidad', $idUnidad)
		    ->leftJoin('Actitud', 'Actitud.id', '=', 'UnidadActitud.idActitud')
		    ->select('Actitud.nombre','Actitud.id as idActitudFK')
		    ->get();
		    
		    return $actitudes;

		}elseif($idRepositorio != null) {
			//dump("No existe referencia unidad");

			$actitudes = Unidad::where('idRepositorio', $idRepositorio)
			->leftJoin('UnidadActitud', 'UnidadActitud.idUnidad', '=', 'Unidad.id')
			->leftJoin('Actitud', 'Actitud.id', '=', 'UnidadActitud.idActitud')
			->select('Actitud.nombre','Actitud.id as idActitudFK')
			->groupBy('idActitudFK')
        	->get();
        	
        	return $actitudes;

		}
		return "";

	}
}
