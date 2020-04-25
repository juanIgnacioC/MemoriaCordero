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
    public $timestamps = false;

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

}
