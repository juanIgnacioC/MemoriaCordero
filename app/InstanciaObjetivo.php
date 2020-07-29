<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaObjetivo extends Model
{
    protected $fillable = [
        'id',
        'idObj',
        'NuevoNombre',
        'idSubEje'
    ];
    protected $table = "InstanciaObjetivo";
    public $timestamps = false;

    public static function obtenerObjetivo($idInstanciaObjetivo)
	{

		$instanciaObjetivo = InstanciaObjetivo::where('InstanciaObjetivo.id', $idInstanciaObjetivo)
	    	->leftJoin('Objetivo', 'Objetivo.idObj', '=', 'InstanciaObjetivo.idObj')
	    	->select('InstanciaObjetivo.id', 'InstanciaObjetivo.NuevoNombre', 'InstanciaObjetivo.idSubEje', 'InstanciaObjetivo.idObj', 'Objetivo.prioridad')
	    	->first();

	    return $instanciaObjetivo;
	}

}
