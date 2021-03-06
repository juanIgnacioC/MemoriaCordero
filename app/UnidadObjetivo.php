<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadObjetivo extends Model
{
    protected $fillable = [
        'id',
        'idUnidad',
        'idObjetivo'
    ];
    protected $table = "UnidadObjetivo";
    public $timestamps = false;

    public static function obtenerPrioritarios($idUnidad){

	    $objetivos = UnidadObjetivo::where('idUnidad', $idUnidad)
	    	->leftJoin('Objetivo', 'Objetivo.id', '=', 'UnidadObjetivo.idObjetivo')
		    ->where('prioridad', 1)
		    ->select('UnidadObjetivo.id', 'Objetivo.idObj', 'Objetivo.nombre','Objetivo.id as idObjetivoFK', 'Objetivo.idSubEje', 'Objetivo.prioridad')
		    ->get();
	    //dump("obtpriot");
	    //dd($objetivos);
	    return $objetivos;
	}

    public static function obtenerObjetivos($idUnidad, $idRepositorio)
	{
		//si existe una referencia a unidad
		if($idUnidad != null){
			//dump("existe referencia unidad");

			$objetivos = UnidadObjetivo::where('idUnidad', $idUnidad)
		    ->leftJoin('Objetivo', 'Objetivo.id', '=', 'UnidadObjetivo.idObjetivo')
		    ->select('UnidadObjetivo.id', 'Objetivo.idObj', 'Objetivo.nombre','Objetivo.id as idObjetivoFK', 'Objetivo.idSubEje', 'Objetivo.prioridad')
		    ->orderBy('Objetivo.prioridad', 'asc')
		    ->get();

		    //dump($objetivos);
		    return $objetivos;

		}elseif($idRepositorio != null) {
			//dump("No existe referencia unidad");

			$objetivos = Unidad::where('idRepositorio', $idRepositorio)
			->leftJoin('UnidadObjetivo', 'UnidadObjetivo.idObjetivo', '=', 'Unidad.id')
			->leftJoin('Objetivo', 'Objetivo.id', '=', 'UnidadObjetivo.idObjetivo')
			->select('UnidadObjetivo.id', 'Objetivo.idObj', 'Objetivo.nombre','Objetivo.id as idObjetivoFK', 'Objetivo.prioridad')
		    ->orderBy('Objetivo.prioridad', 'asc')
			->groupBy('idObjetivoFK')
        	->get();
        	
        	return $objetivos;

		}
		return "";

	}
}
