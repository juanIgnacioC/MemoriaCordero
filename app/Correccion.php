<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correccion extends Model
{
    protected $fillable = [
        'id',
        'idInstanciaUnidad',
        'asignatura',
        'curso',
        'anio',
        'correcciones',
        'estado',
        'idUsuario',
        'idDirectivo',
        'flujo'
    ];
    protected $table = "Correccion";

    public static function directivo($userId)
    {
        //dump("correcciones directivo");
        //obtener correcciones pendientes de un directivo
        $correcciones = Correccion::where('idDirectivo', $userId)
        ->leftJoin('users', 'users.id', '=', 'Correccion.idUsuario')
        ->leftJoin('InstanciaUnidad', 'InstanciaUnidad.id', '=', 'Correccion.idInstanciaUnidad')
        ->where('estado', "1")
        ->select('Correccion.id', 'idInstanciaUnidad', 'asignatura', 'curso', 'anio', 'correcciones', 'estado', 'idUsuario', 'idDirectivo', 'users.name as nombreUsuario', 'type', 'Periodo', 'NuevoNombre as nombreInstanciaUnidad', 'NuevoObjetivoGeneral', 'NuevoNumero', 'idUnidadFK')
        ->get();
        //dd($correcciones);
        return $correcciones;
    }

    public static function docente($userId)
    { 
        //dump("correcciones directivo");
        //obtener correcciones revisadas de un docente
        $correcciones = Correccion::where('idUsuario', $userId)
        ->leftJoin('users', 'users.id', '=', 'Correccion.idUsuario')
        ->leftJoin('InstanciaUnidad', 'InstanciaUnidad.id', '=', 'Correccion.idInstanciaUnidad')
        ->where('estado', "2")
        ->select('Correccion.id', 'idInstanciaUnidad', 'asignatura', 'curso', 'anio', 'correcciones', 'estado', 'flujo', 'idUsuario', 'idDirectivo', 'users.name as nombreUsuario', 'type', 'Periodo', 'NuevoNombre as nombreInstanciaUnidad', 'NuevoObjetivoGeneral', 'NuevoNumero', 'idUnidadFK')
        ->get();
        //dd($correcciones);
        return $correcciones;
    }

    public static function docenteRealizadas($userId)
    { 
        //dump("correcciones directivo");
        //obtener correcciones revisadas de un docente
        $correcciones = Correccion::where('idUsuario', $userId)
        ->leftJoin('users', 'users.id', '=', 'Correccion.idUsuario')
        ->leftJoin('InstanciaUnidad', 'InstanciaUnidad.id', '=', 'Correccion.idInstanciaUnidad')
        ->select('Correccion.id', 'idInstanciaUnidad', 'asignatura', 'curso', 'anio', 'correcciones', 'estado', 'flujo', 'idUsuario', 'idDirectivo', 'users.name as nombreUsuario', 'type', 'Periodo', 'NuevoNombre as nombreInstanciaUnidad', 'NuevoObjetivoGeneral', 'NuevoNumero', 'idUnidadFK')
        ->orderBy('idInstanciaUnidad', 'asc')
        ->get();
        //dd($correcciones);
        return $correcciones;
    }

    public static function docenteCorreccionesRecibidas($userId, $establecimiento, $anio)
    { 
        //dump("correcciones directivo");
        //obtener correcciones revisadas de un docente
        $correcciones = Correccion::where('idUsuario', $userId)
        ->leftJoin('users', 'users.id', '=', 'Correccion.idUsuario')
        ->leftJoin('InstanciaUnidad', 'InstanciaUnidad.id', '=', 'Correccion.idInstanciaUnidad')

        ->leftJoin('InstanciaPlaniAño', 'InstanciaPlaniAño.id', '=', 'InstanciaUnidad.idInstanciaPlaniAño')
        ->where('InstanciaPlaniAño.idInstanciaEstablecimiento', $establecimiento['id'])

        ->where('estado', "2")
        ->whereYear('Correccion.created_at', $anio['anio'])
        ->select('Correccion.id', 'idInstanciaUnidad', 'asignatura', 'curso', 'Correccion.anio', 'correcciones', 'estado', 'flujo', 'idUsuario', 'idDirectivo', 'users.name as nombreUsuario', 'type', 'Periodo', 'NuevoNombre as nombreInstanciaUnidad', 'NuevoObjetivoGeneral', 'NuevoNumero', 'idUnidadFK')
        ->orderBy('idInstanciaUnidad', 'asc')
        ->get();
        //dd($correcciones);
        return $correcciones;
    }

     public static function docenteCorreccionesRecibidasTotal($userId, $establecimiento, $anio)
    { 
        //dump("correcciones directivo");
        //obtener correcciones revisadas de un docente
        $correcciones = Correccion::where('idUsuario', $userId)
        ->leftJoin('users', 'users.id', '=', 'Correccion.idUsuario')
        ->leftJoin('InstanciaUnidad', 'InstanciaUnidad.id', '=', 'Correccion.idInstanciaUnidad')

        ->leftJoin('InstanciaPlaniAño', 'InstanciaPlaniAño.id', '=', 'InstanciaUnidad.idInstanciaPlaniAño')
        ->where('InstanciaPlaniAño.idInstanciaEstablecimiento', $establecimiento['id'])

        ->where('flujo', "2")

        ->whereYear('Correccion.created_at', $anio['anio'])
        ->select('Correccion.id', 'idInstanciaUnidad', 'asignatura', 'curso', 'Correccion.anio', 'correcciones', 'estado', 'flujo', 'idUsuario', 'idDirectivo', 'users.name as nombreUsuario', 'type', 'Periodo', 'NuevoNombre as nombreInstanciaUnidad', 'NuevoObjetivoGeneral', 'NuevoNumero', 'idUnidadFK')
        ->orderBy('idInstanciaUnidad', 'asc')
        ->get();
        //dd($correcciones);
        return $correcciones;
    }


    //Correcciones pendientes de un docente (solicita o le solicitan revisión)
    public static function docenteCorreccionesPendientes($userId, $establecimiento, $anio)
    { 
        //dump("correcciones directivo");
        //obtener correcciones revisadas de un docente
        $correcciones = Correccion::where('idUsuario', $userId)
        ->leftJoin('users', 'users.id', '=', 'Correccion.idUsuario')
        ->leftJoin('InstanciaUnidad', 'InstanciaUnidad.id', '=', 'Correccion.idInstanciaUnidad')

        ->leftJoin('InstanciaPlaniAño', 'InstanciaPlaniAño.id', '=', 'InstanciaUnidad.idInstanciaPlaniAño')
        ->where('InstanciaPlaniAño.idInstanciaEstablecimiento', $establecimiento['id'])

        ->whereYear('Correccion.created_at', $anio['anio'])
        ->where('Correccion.estado', '=', '1')


        ->select('Correccion.id', 'idInstanciaUnidad', 'asignatura', 'curso', 'Correccion.anio', 'correcciones', 'estado', 'flujo', 'idUsuario', 'idDirectivo', 'users.name as nombreUsuario', 'type', 'Periodo', 'NuevoNombre as nombreInstanciaUnidad', 'NuevoObjetivoGeneral', 'NuevoNumero', 'idUnidadFK')
        ->orderBy('idInstanciaUnidad', 'asc')
        ->get();
        //dd($correcciones);
        return $correcciones;
    }



    public static function directivoRealizadas($userId)
    {
        //dump("correcciones directivo");
        //obtener correcciones pendientes de un directivo
        $correcciones = Correccion::where('idDirectivo', $userId)
        ->leftJoin('users', 'users.id', '=', 'Correccion.idUsuario')
        ->leftJoin('InstanciaUnidad', 'InstanciaUnidad.id', '=', 'Correccion.idInstanciaUnidad')
        ->select('Correccion.id', 'idInstanciaUnidad', 'asignatura', 'curso', 'anio', 'correcciones', 'estado', 'flujo' , 'idUsuario', 'idDirectivo', 'users.name as nombreUsuario', 'type', 'Periodo', 'NuevoNombre as nombreInstanciaUnidad', 'NuevoObjetivoGeneral', 'NuevoNumero', 'idUnidadFK')
        ->orderBy('idInstanciaUnidad', 'asc')
        ->get();
        //dd($correcciones);
        return $correcciones;
    }


    public static function administrador()
    { 
        //dump("correcciones directivo");
        //obtener correcciones revisadas de un docente
        $correcciones = Correccion::leftJoin('users', 'users.id', '=', 'Correccion.idUsuario')
        ->leftJoin('InstanciaUnidad', 'InstanciaUnidad.id', '=', 'Correccion.idInstanciaUnidad')
        ->where('estado', "1")
        ->select('Correccion.id', 'idInstanciaUnidad', 'asignatura', 'curso', 'anio', 'correcciones', 'estado', 'flujo', 'idUsuario', 'idDirectivo', 'users.name as nombreUsuario', 'type', 'Periodo', 'NuevoNombre as nombreInstanciaUnidad', 'NuevoObjetivoGeneral', 'NuevoNumero', 'idUnidadFK')
        ->get();
        //dd($correcciones);
        return $correcciones;
    }

    public static function administradorRealizadas()
    { 
        //dump("correcciones directivo");
        //obtener correcciones revisadas de un docente
        $correcciones = Correccion::leftJoin('users', 'users.id', '=', 'Correccion.idUsuario')
        ->leftJoin('InstanciaUnidad', 'InstanciaUnidad.id', '=', 'Correccion.idInstanciaUnidad')
        ->select('Correccion.id', 'idInstanciaUnidad', 'asignatura', 'curso', 'anio', 'correcciones', 'estado', 'flujo', 'idUsuario', 'idDirectivo', 'users.name as nombreUsuario', 'type', 'Periodo', 'NuevoNombre as nombreInstanciaUnidad', 'NuevoObjetivoGeneral', 'NuevoNumero', 'idUnidadFK')
        ->orderBy('idInstanciaUnidad', 'asc')
        ->get();
        //dd($correcciones);
        return $correcciones;
    }

}
