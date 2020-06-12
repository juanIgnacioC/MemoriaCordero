<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SubEje extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'idEje'
    ];
    protected $table = "SubEje";
    public $timestamps = false;

    public static function obtenerSubEjes($objetivos)
	{
		//si existe una referencia a unidad
		if($objetivos != null){
			//dump("obtener subejes");
			$collection = new Collection();

			foreach ($objetivos as $objetivo) {
				$subEje = SubEje::where('id', $objetivo->idSubEje)
				->first();
				$collection->push($subEje);
			}
			return $collection;
		}
		return "0";
	}
}
