<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class IndicadorUnidad extends Model
{
    protected $fillable = [
        'id',
        'tipoIndicador',
        'puntuacion',
        'idInstanciaUnidad'
    ];
    protected $table = "IndicadorUnidad";
    public $timestamps = false;

    public static function moderarIndicadorUnidad($idInstanciaUnidad, $idUnidad, $tipoIndicador, $data, $calculo){

    	//Obtener indicador unidad
    	$indicadorUnidad = IndicadorUnidad::indicadorUnidadTipo($idInstanciaUnidad, $tipoIndicador);

    	//Set puntuacion - calculo correspondiente a cada indicador unidad
    	if($calculo == 1){

    		//Calculo indicador prioridad.
    		if($tipoIndicador == 'prioridad'){

    			//dump("calculo indicador prioridad unidad");
    			$prioritariosUsados = new Collection();
    			if($idUnidad != null)
    			{
    				$prioritariosTotal = UnidadObjetivo::obtenerPrioritarios($idUnidad);
    			}

	    		foreach ($data as $unidadObjetivo) {
	    			$instanciaObjetivo = $unidadObjetivo->nombreObjetivo;
	    			if($instanciaObjetivo->prioridad == 1){
	    				if($instanciaObjetivo->idObj != null && $instanciaObjetivo->idObj != "")
	    					$prioritariosUsados->push($instanciaObjetivo->idObj);
	    			}
	    		}

	    		//Cruce y cálculo
	    		//dd($prioritariosUsados->unique());
	    		$puntuacion = IndicadorUnidad::calculoIndicadorPrioridad($prioritariosUsados->unique(), $prioritariosTotal);
	    		//dump($puntuacion);

	    		//Actualización bd
	    		$indicadorUnidad->puntuacion = $puntuacion;
	    		$indicadorUnidad->save();
	    		return $puntuacion;
    		}

    		//Aqui agregar mas indicadores de unidad segun tipo
    		
    	}
    	//Solamente retornar
    	else{
    		return $indicadorUnidad;
    	}
    }

    public static function indicadorUnidadTipo($idInstanciaUnidad, $tipoIndicador)
	{	
		$indicadorUnidad = IndicadorUnidad::where('IndicadorUnidad.idInstanciaUnidad', $idInstanciaUnidad)
		->where('tipoIndicador', $tipoIndicador)
		->first();

		if($indicadorUnidad != null){
			//dump("if");
			//dump($indicadorUnidad);

	    	return $indicadorUnidad;
		}
		//No hay tabla indicador correspondiente
		else{
			$indicadorUnidad = new IndicadorUnidad([
            'tipoIndicador' => 'prioridad',
            'idInstanciaUnidad' => $idInstanciaUnidad,
            ]);

			//dump("else");
			//dd($indicadorUnidad);
            $indicadorUnidad->save();
            return $indicadorUnidad;
		}

	}

	//cruce: objs priorizados únicos <-> prioritariosTotal
	public static function calculoIndicadorPrioridad($prioritariosUsados, $prioritariosTotal)
	{
		//dump($prioritariosUsados);
		//dump($prioritariosTotal);
		$total = count($prioritariosTotal);
		$usados = 0;
		$flag = 0;
		//dump($total);

		foreach ($prioritariosUsados as $usado) {
			foreach ($prioritariosTotal as $obj) {
				if($usado == $obj->idObj && $flag == 0){
					$usados = $usados + 1;
					$flag = 1;
				}
			}
			$flag = 0;
		}

		//dump($usados);

		$puntuacion = $usados / $total * 5;
		return($puntuacion);
		//dd($puntuacion);

		/*$cruce = $total - $usados;
		if($cruce <= 0)
			$cruce = 0;*/

	}
}
