<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaPlaniAño extends Model
{
    protected $fillable = [
        'id',
        'anio',
        'idInstanciaEstablecimiento',
        'idRepositorio',
    ];
    protected $table = "InstanciaPlaniAño";
    public $timestamps = false;

    public static function obtenerPlanificacionesEstablecimiento($establecimientos)
	{	
		foreach ($establecimientos as $establecimiento) {
			$instancia = InstanciaPlaniAño::where('idInstanciaEstablecimiento', $establecimiento['id'])
			->leftJoin('RepositorioPlanificacion', 'RepositorioPlanificacion.id', '=', 'InstanciaPlaniAño.idRepositorio')
			->leftJoin('Curso', 'Curso.id', '=', 'RepositorioPlanificacion.idCurso')
			->leftJoin('Asignatura', 'Asignatura.id', '=', 'RepositorioPlanificacion.idAsignatura')
			->select('InstanciaPlaniAño.id','InstanciaPlaniAño.anio', 'Curso.nombre as nombreCurso', 'Asignatura.nombre as nombreAsignatura')
			->get();
			//dd($instancia);
		}
		
		return $repositorios;

	}

	public static function obtenerAnios($establecimiento)
	{	
		$instancia = InstanciaPlaniAño::where('idInstanciaEstablecimiento', $establecimiento['id'])
		->select('InstanciaPlaniAño.anio')
		->orderBy('anio', 'desc')
		->groupBy('InstanciaPlaniAño.anio')
		->get();
		
		return $instancia;

	}

	public static function obtenerPlanificacionesEstablecimientoAnio($establecimiento, $anio)
	{	
		$instancia = InstanciaPlaniAño::where('idInstanciaEstablecimiento', $establecimiento['id'])
		->where('anio', $anio['anio'])
		->leftJoin('RepositorioPlanificacion', 'RepositorioPlanificacion.id', '=', 'InstanciaPlaniAño.idRepositorio')
		->leftJoin('Curso', 'Curso.id', '=', 'RepositorioPlanificacion.idCurso')
		->leftJoin('Asignatura', 'Asignatura.id', '=', 'RepositorioPlanificacion.idAsignatura')
		->select('InstanciaPlaniAño.id','InstanciaPlaniAño.anio', 'Curso.nombre as nombreCurso', 'Asignatura.nombre as nombreAsignatura')
		->get();
		//dd($instancia);
		
		return $instancia;

	}

	public static function obtenerPlanificacionesEstablecimientoAnioId($establecimiento, $anio)
	{	
		$instancia = InstanciaPlaniAño::where('idInstanciaEstablecimiento', $establecimiento)
		->where('anio', $anio)
		->leftJoin('RepositorioPlanificacion', 'RepositorioPlanificacion.id', '=', 'InstanciaPlaniAño.idRepositorio')
		->leftJoin('Curso', 'Curso.id', '=', 'RepositorioPlanificacion.idCurso')
		->leftJoin('Asignatura', 'Asignatura.id', '=', 'RepositorioPlanificacion.idAsignatura')
		->select('InstanciaPlaniAño.id','InstanciaPlaniAño.anio', 'Curso.nombre as nombreCurso', 'Asignatura.nombre as nombreAsignatura')
		->get();
		//dd($instancia);
		
		return $instancia;

	}

	public static function obtenerPlanificacionesAlumno($establecimiento, $anio)
	{	
		$instancia = InstanciaPlaniAño::where('anio', $anio)
		->leftJoin('InstanciaEstablecimiento', 'InstanciaEstablecimiento.idEstablecimiento', '=', 1)
		->where('idInstanciaEstablecimiento', 'InstanciaEstablecimiento.id')
		->get();
		//dd($instancia);
		
		return $instancia;

	}

	//Data para luego obtener los alumnos
	public static function obtenerDataAlumnos($idInstanciaPlaniAño)
	{	
		$instancia = InstanciaPlaniAño::where('InstanciaPlaniAño.id', $idInstanciaPlaniAño)
		->leftJoin('RepositorioPlanificacion', 'RepositorioPlanificacion.id', '=', 'InstanciaPlaniAño.idRepositorio')
		->leftJoin('Curso', 'Curso.id', '=', 'RepositorioPlanificacion.idCurso')
		->leftJoin('InstanciaEstablecimiento', 'InstanciaEstablecimiento.id', '=', 'InstanciaPlaniAño.idInstanciaEstablecimiento')
		->leftJoin('Establecimiento', 'Establecimiento.id', '=', 'InstanciaEstablecimiento.idEstablecimiento')
		->select('InstanciaPlaniAño.id','InstanciaPlaniAño.anio', 'Curso.id as idCurso', 'Curso.nombre as nombreCurso', 'InstanciaPlaniAño.indice', 'InstanciaEstablecimiento.id as idInstanciaEstablecimiento', 'Establecimiento.id as idEstablecimiento', 'Establecimiento.nombre as nombreEstablecimiento')
		->first();
		//dd($instancia);
		
		return $instancia;

	}

	//Data para obtener clases de un curso y asignatura
	public static function obtenerClases($idInstanciaPlaniAño)
	{	
		$instancia = InstanciaPlaniAño::where('InstanciaPlaniAño.id', $idInstanciaPlaniAño)
		->leftJoin('InstanciaUnidad', 'InstanciaUnidad.idInstanciaPlaniAño', '=', 'InstanciaPlaniAño.id')
		->leftJoin('InstanciaClase', 'InstanciaClase.idInstanciaUnidad', '=', 'InstanciaUnidad.id')
		->first();
		dd($instancia);
		
		return $instancia;

	}
}
