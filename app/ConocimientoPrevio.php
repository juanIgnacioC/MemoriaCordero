<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConocimientoPrevio extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'idUnidad'
    ];
    protected $table = "ConocimientoPrevio";
    public $timestamps = false;

    public static function obtenerConocimientos($idUnidad, $idRepositorio)
	{
		//si existe una referencia a unidad
		if($idUnidad != null){
			//dump("existe referencia unidad");

			$conocimientos = ConocimientoPrevio::where('idUnidad', $idUnidad)
		    ->get();
		    
		    return $conocimientos;

		}elseif($idRepositorio != null) {
			//dump("No existe referencia unidad");

			$conocimientos = Unidad::where('idRepositorio', $idRepositorio)
			->leftJoin('ConocimientoPrevio', 'ConocimientoPrevio.idUnidad', '=', 'Unidad.id')
        	->get();
        	
        	return $conocimientos;

		}
		return "";

	}
}
