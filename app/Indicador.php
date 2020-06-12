<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Indicador extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'idUnidadObjetivo'
    ];
    protected $table = "Indicador";
    public $timestamps = false;

    public static function obtenerIndicadores($objetivos)
	{
		//si existe una referencia a unidad
		if($objetivos != null){
			//dump("obtener indicadores");
			$collection = new Collection();

			foreach ($objetivos as $objetivo) {
				$indicadores = Indicador::where('idUnidadObjetivo', $objetivo->id)
				->get();
				$collection->push($indicadores);
			}
			return $collection;
		}
		return "0";
	}
}
