<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retroalimentacion extends Model
{
    protected $fillable = [
        'id',
        'idInstanciaClase',
        'fecha',
        'puntuacion',
        'comentario',
        'idInstanciaPlaniAnio',
        'idAlumno',
        'idDocente'
    ];
    protected $table = "Retroalimentacion";
    public $timestamps = false;

    public static function claseRetroalimentada($idInstanciaClase, $idAlumno)
    {   
        $instancia = Retroalimentacion::where('Retroalimentacion.idInstanciaClase', $idInstanciaClase)
        ->where('Retroalimentacion.idAlumno', $idAlumno)
        ->first();

        return $instancia;

    }

    //Retros recientes por docente para dashboard. limit 10
    public static function retroalimentacionesRecientesDocente($idDocente)
    {   
        $retroalimentaciones = Retroalimentacion::where('Retroalimentacion.idDocente', $idDocente)
        ->leftJoin('InstanciaClase', 'InstanciaClase.id', '=', 'Retroalimentacion.idInstanciaClase')
        ->leftJoin('InstanciaPlaniAño', 'InstanciaPlaniAño.id', '=', 'Retroalimentacion.idInstanciaPlaniAnio')

        ->leftJoin('RepositorioPlanificacion', 'RepositorioPlanificacion.id', '=', 'InstanciaPlaniAño.idRepositorio')
        ->leftJoin('Asignatura', 'Asignatura.id', '=', 'RepositorioPlanificacion.idAsignatura')
        ->leftJoin('Curso', 'Curso.id', '=', 'RepositorioPlanificacion.idCurso')

        ->select('InstanciaClase.id', 'InstanciaClase.start', 'Retroalimentacion.comentario', 'Retroalimentacion.fecha', 'Retroalimentacion.idInstanciaPlaniAnio', 'Asignatura.nombre as nombreAsignatura', 'Curso.nombre as nombreCurso')

        ->orderBy('Retroalimentacion.fecha', 'desc')
        ->limit(10)
        ->get();

        return $retroalimentaciones;

    }

    public static function retroalimentacionesRecientes($idInstanciaPlaniAnio, $idDocente)
    {   
        $retroalimentaciones = Retroalimentacion::where('Retroalimentacion.idInstanciaPlaniAnio', $idInstanciaPlaniAnio)
        ->where('Retroalimentacion.idDocente', $idDocente)
        ->leftJoin('InstanciaClase', 'InstanciaClase.id', '=', 'Retroalimentacion.idInstanciaClase')
        ->get();

        return $retroalimentaciones;

    }

    public static function obtenerAlumnos($idEstablecimiento, $idCurso, $indice, $anio)
    {
        $alumnos = InstanciaEstablecimientoAlumno::where('idEstablecimiento', $idEstablecimiento)
        ->where('curso', $idCurso)
        ->where('indice', $indice)
        ->whereYear('fecha', $anio)
        ->leftJoin('users', 'users.id', '=', 'InstanciaEstablecimientoAlumno.idAlumno')
        ->select('InstanciaEstablecimientoAlumno.id','InstanciaEstablecimientoAlumno.fecha', 'InstanciaEstablecimientoAlumno.type', 'InstanciaEstablecimientoAlumno.idAlumno as idAlumno', 'users.name')
        ->orderBy('users.name', 'asc')
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
