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

	public static function obtenerDirectivo($id)
    {
        $directivo = InstanciaEstablecimiento::where('InstanciaEstablecimiento.idEstablecimiento', $id)
        ->leftJoin('users', 'users.id', '=', 'InstanciaEstablecimiento.idDocente')
        ->where('users.type','2')
        ->select('users.id', 'users.name', 'users.email', 'users.type')
        ->first();

	    return $directivo;
    }
}
