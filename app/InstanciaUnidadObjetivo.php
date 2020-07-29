<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class InstanciaUnidadObjetivo extends Model
{
    protected $fillable = [
        'id',
        'idInstanciaUnidad',
        'idInstanciaObjetivo'
    ];
    protected $table = "InstanciaUnidadObjetivo";
    public $timestamps = false;

    public static function dataPlaniUnidad($idUnidad)
	{
		//dump("obteniendo dataPlaniUnidad");
		$dataPlaniUnidad = new Collection();

		$instanciasUnidadObjetivo = InstanciaUnidadObjetivo::where('idInstanciaUnidad', $idUnidad)
	    ->get();
	    //$dataPlaniUnidad = collect($instanciasUnidadObjetivo);
	    
	    //dd($dataPlaniUnidad);

	    //dump($instanciasUnidadObjetivo);

	    for ($i=0; $i < $instanciasUnidadObjetivo->count() ; $i++) {
	    	$unidadObjetivo = $instanciasUnidadObjetivo[$i];
	    	//dump("For unidadObjetivo");

	    	//objetivo
	    	/*$instanciaObjetivo = InstanciaObjetivo::where('id', $unidadObjetivo->idInstanciaObjetivo)
	    	->first();*/

	    	//Obtener objetivo con prioridad
	    	$instanciaObjetivo = InstanciaObjetivo::obtenerObjetivo($unidadObjetivo->idInstanciaObjetivo);

	    	//dump($instanciaObjetivo);

	    	//conocimientos previos
	    	$instanciasConocimientoPrevio = InstanciasConocimientoPrevio::where('idInstanciaUnidadObjetivo', $unidadObjetivo->id)
	    	->get();

	    	//dump($instanciasConocimientoPrevio);

	    	//indicadores
	    	$indicadores = InstanciaIndicador::where('idInstanciaUnidadObjetivo', $unidadObjetivo->id)
	    	->get();

	    	//dump($indicadores);

	    	//actividades
	    	$actividades = InstanciaActividad::where('idInstanciaUnidadObjetivo', $unidadObjetivo->id)
	    	->first();

	    	//dump($actividades);

	    	//evaluacion
	    	$evaluacion = InstanciaEvaluacion::where('idInstanciaUnidadObjetivo', $unidadObjetivo->id)
	    	->first();

	    	//dump($evaluacion);

	    	//crear modelo de datos de plani unidad
	    	//dump("pushing");
	    	$data = new DataPlaniUnidad([
	            'id' => $unidadObjetivo->id,
		        'nombreObjetivo' => $instanciaObjetivo,
		        'conocimientos' => $instanciasConocimientoPrevio,
		        'actividades' => $actividades,
		        'indicadores' => $indicadores,
		        'evaluacion' => $evaluacion,
		        'idInstanciaUnidad' => $idUnidad
            ]);
	    	//dump($data);
	    	$dataPlaniUnidad->push($data);
	    }
	    //dd($dataPlaniUnidad);
	    return $dataPlaniUnidad;
	}
}
