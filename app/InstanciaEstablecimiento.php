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
	    ->select('InstanciaEstablecimiento.id','Establecimiento.nombre', 'Establecimiento.isSemestral', 'InstanciaEstablecimiento.idEstablecimiento')
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

    public static function obtenerDocentes($id)
    {
        //dump($id);
        $docentes = InstanciaEstablecimiento::where('InstanciaEstablecimiento.idEstablecimiento', $id['idEstablecimiento'])
        ->leftJoin('users', 'users.id', '=', 'InstanciaEstablecimiento.idDocente')
        ->where('users.type','1')
        ->select('users.id', 'users.name', 'users.email')
        ->get();

        return $docentes;
    }

    public static function obtenerInstanciasAlumno($establecimiento, $anio)
    {
        $establecimientos = InstanciaEstablecimiento::where('idEstablecimiento', $establecimiento['idEstablecimiento'])
        ->leftJoin('InstanciaPlaniAño', 'InstanciaPlaniAño.idInstanciaEstablecimiento', '=', 'InstanciaEstablecimiento.id')
        ->leftJoin('RepositorioPlanificacion', 'RepositorioPlanificacion.id', '=', 'InstanciaPlaniAño.idRepositorio')
        ->leftJoin('Curso', 'Curso.id', '=', 'RepositorioPlanificacion.idCurso')
        ->leftJoin('Asignatura', 'Asignatura.id', '=', 'RepositorioPlanificacion.idAsignatura')
        ->where('InstanciaPlaniAño.indice', $establecimiento['indice'])
        ->where('Curso.id', $establecimiento['curso'])
        ->where('InstanciaPlaniAño.anio', $anio)

        ->select('InstanciaPlaniAño.id','InstanciaPlaniAño.anio', 'Curso.nombre as nombreCurso', 'Asignatura.nombre as nombreAsignatura', 'InstanciaPlaniAño.indice')

        ->get();
        return $establecimientos;
    }
}
