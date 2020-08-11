<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

use App\Asignatura;
use App\Curso;
use App\InstanciaPlaniAño;
use App\Unidad;
use App\InstanciaUnidad;
use App\Establecimiento;
use App\InstanciaEstablecimiento;
use App\RepositorioPlanificacion;

use App\Correccion;
use App\Retroalimentacion;

class ChartsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$user = Auth::user();
        if($user->privilegioDocenteExclusivo($user['type']) ) {
        	//ver planificaciones docente y calculos

        	//Tabla intermedia Indicador? atribute updated?. tupla por unidad? ->de esto calcular general? (optimización?)
        	//Realizar cada vez
            $establecimientos = InstanciaEstablecimiento::obtenerInstancias($user['id']);
            $anios = InstanciaPlaniAño::obtenerAnios($establecimientos->get(0));

            //obtener instancias solo de los establecimientos del docente
            //$instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimiento($establecimientos);

            //obtener instancias solo del establecimiento y año seleccionado
            $instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimientoAnio($establecimientos->get(0), $anios->get(0));

            //////Conteo correcciones recibidas
            $correccionesRecibidas = Correccion::docenteCorreccionesRecibidas($user['id'], $establecimientos->get(0), $anios->get(0));
            //dump($correccionesRecibidas);
            $conteoCorrecciones = count($correccionesRecibidas);

            //////Conteo correcciones pendientes
            $correccionesPendientes = Correccion::docenteCorreccionesPendientes($user['id'], $establecimientos->get(0), $anios->get(0));
            //dump($correccionesPendientes);
            $conteoPendientes = count($correccionesPendientes);

            //////Conteo correcciones recibidas total
            $correccionesRecibidasTotal = Correccion::docenteCorreccionesRecibidasTotal($user['id'], $establecimientos->get(0), $anios->get(0));
            //dump($correccionesRecibidasTotal);
            $conteoCorreccionesTotal = count($correccionesRecibidasTotal);

            //////Conteo retroalimentaciones recibidas
            $retroalimentacionesRecibidas = Retroalimentacion::retroalimentacionesRecibidasDocente($user['id'], $establecimientos->get(0), $anios->get(0) );

            $conteoRetroalimentaciones = count($retroalimentacionesRecibidas);
            //dd($conteoRetroalimentaciones);

            //////Conteo usuarios establecimiento
            $docentesEstablecimiento = InstanciaEstablecimiento::obtenerDocentes($establecimientos->get(0));
            $conteoDocentes = count($docentesEstablecimiento);


            


            return view('charts.docente', ['instanciasPlaniAño'=> $instanciasPlaniAño, 'establecimientos'=> $establecimientos, 'anios'=> $anios, 'correccionesRecibidas'=> $correccionesRecibidas, 'correccionesPendientes'=> $correccionesPendientes, 'correccionesRecibidasTotal'=> $correccionesRecibidasTotal, 'retroalimentacionesRecibidas'=> $retroalimentacionesRecibidas, 'conteoDocentes'=> $conteoDocentes]);

        }
        elseif($user->privilegioDirectivoExclusivo($user['type']) ){
            return view('charts.index');
        }
        elseif ($user->privilegioAlumnoExclusivo($user['type']) ){
            return view('charts.index');
        }
        elseif ($user->privilegioAdministrador($user['type']) ){
            return view('charts.index');
        }

        return view('errors.privilegios');
    }
}
