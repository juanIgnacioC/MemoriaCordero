<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Asignatura;
use App\Curso;
use App\InstanciaPlaniAño;
use App\Establecimiento;
use App\InstanciaEstablecimiento;
use App\RepositorioPlanificacion;

class TablesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	return view('tables.index');
    }

    public function planifications()
    {
        //$repositorios = RepositorioPlanificacion::obtenerRepositorios();
        //$establecimientos = Establecimiento::all();

        $user = Auth::user();
        $userId =  $user['id'];
        //HardCode Docente id
        //$userId = '1';

        //Join establecimiento instanciaEstablecimiento y docente/
        //dropdown seleccionar establecimiento y año
        $establecimientos = InstanciaEstablecimiento::obtenerInstancias($userId);
        $anios = InstanciaPlaniAño::obtenerAnios($establecimientos->first());

        //obtener instancias solo de los establecimientos del docente
        //$instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimiento($establecimientos);

        //obtener instancias solo del establecimiento y año seleccionado
        $instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimientoAnio($establecimientos->first(), $anios->first());

        //dd($instanciasPlaniAño);
        


        //$asignaturas = DB::select('select * from Asignatura');
        //$cursos = DB::select('select * from Curso');
        //$establecimientos = DB::select('select * from Establecimiento');
        //$instanciasEstablecimientos = DB::select('select * from InstanciasEstablecimiento');
        //$asignaturas = Asignatura::$asignatura;
        
        //$name = 'Victoria'
        //return view('forms.common',['asignaturas'=> $asignaturas, 'cursos'=> $cursos, 'establecimientos'=> $establecimientos]);
        //return view('forms.common', $asignaturas, $cursos);
        return view('tables.planifications', ['instanciasPlaniAño'=> $instanciasPlaniAño, 'establecimientos'=> $establecimientos, 'anios'=> $anios]);
    }
}
