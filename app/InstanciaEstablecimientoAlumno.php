<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaEstablecimientoAlumno extends Model
{
    protected $fillable = [
        'id',
        'fecha',
        'idEstablecimiento',
        'curso',
        'indice',
        'type',
        'idAlumno'
    ];
    protected $table = "InstanciaEstablecimientoAlumno";
    public $timestamps = false;

    public static function obtenerAlumnos($idEstablecimiento, $idCurso, $indice, $anio)
    {
        $alumnos = InstanciaEstablecimientoAlumno::where('idEstablecimiento', $idEstablecimiento)
        ->where('curso', $idCurso)
        ->where('indice', $indice)
        ->whereYear('fecha', $anio)
        ->leftJoin('users', 'users.id', '=', 'InstanciaEstablecimientoAlumno.idAlumno')
        ->select('InstanciaEstablecimientoAlumno.id','InstanciaEstablecimientoAlumno.fecha', 'InstanciaEstablecimientoAlumno.type', 'InstanciaEstablecimientoAlumno.idAlumno as idAlumno', 'users.name')
        ->get();

        //dd($alumnos);
        return $alumnos;
    }


	public static function obtenerInstancias($userId)
	{
		$establecimientos = InstanciaEstablecimientoAlumno::where('idAlumno', $userId)
	    ->leftJoin('Establecimiento', 'Establecimiento.id', '=', 'InstanciaEstablecimientoAlumno.idEstablecimiento')
	    ->select('InstanciaEstablecimientoAlumno.id','Establecimiento.nombre', 'Establecimiento.isSemestral')
	    ->get();
	    return $establecimientos;
	}

	public static function obtenerDirectivo($id)
    {
        $directivo = InstanciaEstablecimientoAlumno::where('InstanciaEstablecimientoAlumno.idEstablecimiento', $id)
        ->leftJoin('users', 'users.id', '=', 'InstanciaEstablecimientoAlumno.idAlumno')
        ->where('users.type','2')
        ->select('users.id', 'users.name', 'users.email', 'users.type')
        ->first();

	    return $directivo;
    }
}
