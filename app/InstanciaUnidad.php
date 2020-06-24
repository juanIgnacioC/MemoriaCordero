<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

	//Data para obtener clases de un curso y asignatura
	//con idAlumno verifica si la clase en particular ya fue retroalimentada por este
	public static function obtenerClases($idInstanciaPlaniAño, $idAlumno)
	{	
		$instancia = InstanciaUnidad::where('InstanciaUnidad.idInstanciaPlaniAño', $idInstanciaPlaniAño)
		->leftJoin('InstanciaClase', 'InstanciaClase.idInstanciaUnidad', '=', 'InstanciaUnidad.id')
		->leftJoin('Retroalimentacion', function ($join) use($idAlumno) {
		 	$join->on('Retroalimentacion.idInstanciaClase', '=', 'InstanciaClase.id')
		 	->where('Retroalimentacion.idAlumno', '=', $idAlumno);
			})
		->whereRaw('yearweek(start, 1) = yearweek(now(), 1)' )
		->whereRaw('now() > start')
		->select('InstanciaClase.id', 'InstanciaClase.start', 'InstanciaClase.contenidos', 'InstanciaClase.description', 'InstanciaClase.recursos', 'InstanciaUnidad.NuevoNombre as nombreUnidad', 'InstanciaUnidad.NuevoNumero as numeroUnidad', 'InstanciaUnidad.Periodo as periodoUnidad', 'InstanciaUnidad.NuevoObjetivoGeneral as nombreObjetivoGeneral', 'idInstanciaPlaniAño', 'InstanciaUnidad.id as idInstanciaUnidad', 'Retroalimentacion.id as idRetroalimentacion' )
		->get();

		return $instancia;

	}

	//Data para obtener clases de un curso y asignatura
	//con idAlumno verifica si la clase en particular ya fue retroalimentada por este
	public static function obtenerClasesDocente($idInstanciaPlaniAño, $idDocente)
	{	
		$instancia = InstanciaUnidad::where('InstanciaUnidad.idInstanciaPlaniAño', $idInstanciaPlaniAño)
		->leftJoin('InstanciaClase', 'InstanciaClase.idInstanciaUnidad', '=', 'InstanciaUnidad.id')
		->leftJoin('Retroalimentacion', 'Retroalimentacion.idInstanciaClase', '=', 'InstanciaClase.id')
		->where('Retroalimentacion.idDocente', '=', $idDocente)
		->orderBy('start', 'asc')
		->select('InstanciaClase.id', 'InstanciaClase.start', 'InstanciaClase.contenidos', 'InstanciaClase.description', 'InstanciaClase.recursos', 'InstanciaUnidad.NuevoNombre as nombreUnidad', 'InstanciaUnidad.NuevoNumero as numeroUnidad', 'InstanciaUnidad.Periodo as periodoUnidad', 'InstanciaUnidad.NuevoObjetivoGeneral as nombreObjetivoGeneral', 'idInstanciaPlaniAño', 'InstanciaUnidad.id as idInstanciaUnidad', 'Retroalimentacion.id as idRetroalimentacion', 'Retroalimentacion.puntuacion', 'Retroalimentacion.comentario', 'Retroalimentacion.idAlumno' )
		->get();

		return $instancia;

	}

	public static function dataClases($idInstanciaPlaniAño, $idDocente)
	{
		//dump("obteniendo dataClases");
		$dataClases = new Collection();

		$instanciasUnidad = InstanciaUnidad::where('idInstanciaPlaniAño', $idInstanciaPlaniAño)
		->orderBy('NuevoNumero', 'asc')
	    ->get();
	    //$dataClases = collect($instanciasUnidadObjetivo);
	    
	    //dd($dataClases);

	    dd($instanciasUnidad);

	    for ($i=0; $i < $instanciasUnidad->count() ; $i++) {
	    	$unidad = $instanciasUnidad[$i];
	    	//dump("For unidad");

	    	//objetivo
	    	$instanciaObjetivo = InstanciaObjetivo::where('id', $unidad->idInstanciaObjetivo)
	    	->first();

	    	//dump($instanciaObjetivo);

	    	//conocimientos previos
	    	$instanciasConocimientoPrevio = InstanciasConocimientoPrevio::where('idInstanciaUnidadObjetivo', $unidad->id)
	    	->get();

	    	//dump($instanciasConocimientoPrevio);

	    	//indicadores
	    	$indicadores = InstanciaIndicador::where('idInstanciaUnidadObjetivo', $unidad->id)
	    	->get();

	    	//dump($indicadores);

	    	//actividades
	    	$actividades = InstanciaActividad::where('idInstanciaUnidadObjetivo', $unidad->id)
	    	->first();

	    	//dump($actividades);

	    	//evaluacion
	    	$evaluacion = InstanciaEvaluacion::where('idInstanciaUnidadObjetivo', $unidad->id)
	    	->first();

	    	//dump($evaluacion);

	    	//crear modelo de datos de plani unidad
	    	//dump("pushing");
	    	$data = new DataClases([
	            'id' => $unidad->id,
		        'nombreObjetivo' => $instanciaObjetivo,
		        'conocimientos' => $instanciasConocimientoPrevio,
		        'actividades' => $actividades,
		        'indicadores' => $indicadores,
		        'evaluacion' => $evaluacion,
		        'idInstanciaUnidad' => $idUnidad
            ]);
	    	//dump($data);
	    	$dataClases->push($data);
	    }
	    //dd($dataClases);
	    return $dataClases;
	}
}
