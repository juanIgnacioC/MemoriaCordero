<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanciaUnidad extends Model
{
    protected $fillable = [
        'id',
        'Periodo',
        'NuevoNombre',
        'NuevoObjetivoGeneral',
        'NuevoNumero',
        'fechaInicio',
        'fechaTermino',
        'idInstanciaPlaniAño',
        'idUnidadFK'
    ];
    protected $table = "InstanciaUnidad";
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
			dd($instancia);
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
}
