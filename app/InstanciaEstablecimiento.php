<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaEstablecimiento extends Model
{
    protected $fillable = [
        'id',
        'fecha',
        'idEstablecimiento',
        'idDocente',
    ];
    protected $table = "InstanciaEstablecimiento";
    public $timestamps = false;


	public static function obtenerInstancias($userId)
	{
		$establecimientos = InstanciaEstablecimiento::where('idDocente', $userId)
	    ->leftJoin('Establecimiento', 'Establecimiento.id', '=', 'InstanciaEstablecimiento.idEstablecimiento')
	    ->select('InstanciaEstablecimiento.id','Establecimiento.nombre', 'Establecimiento.isSemestral')
	    ->get();
	    return $establecimientos;
	}
}
