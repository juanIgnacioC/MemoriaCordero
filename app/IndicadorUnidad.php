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
	    		//0: puntuacion. 1: objs prioritarios no usados.
	    		$puntuacion = IndicadorUnidad::calculoIndicadorPrioridad($prioritariosUsados->unique(), $prioritariosTotal);
	    		//dump($puntuacion);
	    		//dump($puntuacion[1]);

	    		//Actualización bd
	    		$indicadorUnidad->puntuacion = $puntuacion[0];
	    		$indicadorUnidad->save();
	    		return $puntuacion;
    		}

    		else if($tipoIndicador == 'habilidad'){

    			//Ver si hay habilidades
	    		if(count($data) > 0){
	    			//dump("mayor a cero");
	    			$puntuacion = 5;
	    		}
	    		else{
	    			//dump("cero");
	    			$puntuacion = 0;
	    		}

	    		//Actualización bd
	    		$indicadorUnidad->puntuacion = $puntuacion;
	    		$indicadorUnidad->save();
	    		return $puntuacion;
    		}

    		else if($tipoIndicador == 'actitud'){

    			//Ver si hay actitudes
	    		if(count($data) > 0){
	    			//dump("mayor a cero");
	    			$puntuacion = 5;
	    		}
	    		else{
	    			//dump("cero");
	    			$puntuacion = 0;
	    		}

	    		//Actualización bd
	    		$indicadorUnidad->puntuacion = $puntuacion;
	    		$indicadorUnidad->save();
	    		return $puntuacion;
    		}

    		else if($tipoIndicador == 'clases'){

    			//dump($data);

	    		//Cruce y cálculo
	    		//0: puntuacion. 1: clases no terminadas.
	    		$puntuacion = IndicadorUnidad::calculoIndicadorClases($data);
	    		$puntuacion[0] = round($puntuacion[0], 1);
	    		//dump($puntuacion);
	    		//dump($puntuacion[1]);

	    		//Actualización bd
	    		$indicadorUnidad->puntuacion = $puntuacion[0];
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
            'tipoIndicador' => $tipoIndicador,
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
		$dataPrioridad = new Collection();
		//dump($prioritariosUsados);
		//dump($prioritariosTotal);
		$total = count($prioritariosTotal);
		$usados = 0;
		$flag = 0;
		//dump($total);
		$prioritariosNoUsados = $prioritariosTotal;
		//dump($prioritariosNoUsados);
		foreach ($prioritariosUsados as $usado) {
			foreach ($prioritariosTotal as $obj) {
				if($usado == $obj->idObj && $flag == 0){
					$usados = $usados + 1;
					$flag = 1;

					$prioritariosNoUsados = $prioritariosNoUsados->filter(function($item) use ($obj){
					    return $item->idObj != $obj->idObj;
					});
					//dump($prioritariosNoUsados);
				}
			}
			$flag = 0;
		}

		//dump($usados);
		if($total != 0)
			$puntuacion = $usados / $total * 5;
		else
			$puntuacion = 0;

		$dataPrioridad->push(round($puntuacion, 1) );
		$dataPrioridad->push($prioritariosNoUsados);
		return($dataPrioridad);
		//dd($puntuacion);

		/*$cruce = $total - $usados;
		if($cruce <= 0)
			$cruce = 0;*/

	}

	//calculo indicador clases unidad
	public static function calculoIndicadorClases($clases)
	{
		$dataClases = new Collection();
		//dump($prioritariosUsados);
		//dump($prioritariosTotal);
		$total = count($clases);
		$usados = 0;
		//dump($total);
		$clasesNoTerminadas = $clases;

		foreach ($clases as $clase) {
			if($clase->contenidos != null && $clase->contenidos != ""){
				$usados = $usados + 1;
				//dump($prioritariosNoUsados);
			}
		}

		$clasesNoTerminadas = $clasesNoTerminadas->filter(function($item){
		    return ($item->contenidos == null || $item->contenidos == "");
		});

		//dump($usados);
		if($total != 0)
			$puntuacion = $usados / $total * 5;
		else
			$puntuacion = 0;

		$dataClases->push($puntuacion);
		$dataClases->push($clasesNoTerminadas);
		//dd($dataClases);

		return($dataClases);
		//dd($puntuacion);

		/*$cruce = $total - $usados;
		if($cruce <= 0)
			$cruce = 0;*/

	}
}
