<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\User;

use App\Asignatura;
use App\Curso;
use App\InstanciaPlaniAño;
use App\Unidad;
use App\InstanciaUnidad;
use App\Establecimiento;
use App\InstanciaEstablecimiento;
use App\RepositorioPlanificacion;

use App\IndicadorUnidad;

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

            /* Reportes */

            $indicadorPlaniAnio = new Collection();
            $indicadorPlaniAnioClases = new Collection();
            $clasesRecientes = new Collection();

            $planificacionesFinalizadas = 0;
            $planificacionesPendientes = 0;

            foreach ($instanciasPlaniAño as $planiAnio) {

                $instanciaUnidades = InstanciaUnidad::where('idInstanciaPlaniAño', $planiAnio->id)
                ->get();

                $unidad = new Collection();
                foreach ($instanciaUnidades as $instanciaUnidad) {

                    $indicadoresUnidad = IndicadorUnidad::where('idInstanciaUnidad', $instanciaUnidad->id)
                    ->avg('IndicadorUnidad.puntuacion');
                    
                    //dump($indicadoresUnidad);
                    $unidad->push($indicadoresUnidad);

                }

                //Promedio unidades
                //dd($unidad);
                $avgUnidades = $unidad->avg();
                if($avgUnidades == null) //no existen indics
                    $avgUnidades = 0;
                //dd($avgUnidades);

                //Promedio planificacion año con id. 0:id, 1:avg
                // ej: Matemáticas 4to: 5
                
                /*$plani = new Collection();
                $plani->push($planiAnio->id);
                $plani->push($avgUnidades);*/

                //Promedio planificacion anio
                //$indicadorPlaniAnio->push($plani);
                $dataClases = InstanciaUnidad::dataClases($planiAnio->id, $user['id']);
                $avgClases = $dataClases->avg('avgRetroUnidad');
                if($avgClases == null) //no existen indics
                    $avgClases = 0;
                //////////dump($dataClases);
                //$collection->put('price', 100);
                $indicadorPlaniAnio->push(round($avgUnidades, 1) ); //Ingreso directo->avg

                //////Conteo planificaciones finalizadas
                if(round($avgUnidades, 1) >= 4)
                    $planificacionesFinalizadas = $planificacionesFinalizadas + 1;
                else
                    $planificacionesPendientes = $planificacionesPendientes + 1;

                $indicadorPlaniAnioClases->push(round($avgClases, 1) );

                /*if(count($dataClases) > 0){
                    $clasesR = Retroalimentacion::retroalimentacionesRecientes($planiAnio->id, $user['id']);
                }

                if(!$clasesR->isEmpty())
                    $clasesRecientes->push($clasesR);*/ // clases recientes por planiAño
            }
            //dump($indicadorPlaniAnio);
            //dump($indicadorPlaniAnioClases);

            dump($planificacionesFinalizadas);
            dump($planificacionesPendientes);



            /* Indicadores */

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


            


            return view('charts.docente', ['instanciasPlaniAño'=> $instanciasPlaniAño, 'establecimientos'=> $establecimientos, 'anios'=> $anios, 'correccionesRecibidas'=> $correccionesRecibidas, 'correccionesPendientes'=> $correccionesPendientes, 'correccionesRecibidasTotal'=> $correccionesRecibidasTotal, 'retroalimentacionesRecibidas'=> $retroalimentacionesRecibidas, 'conteoDocentes'=> $conteoDocentes, 'indicadorPlaniAnio'=> $indicadorPlaniAnio, 'indicadorPlaniAnioClases'=> $indicadorPlaniAnioClases, 'planificacionesFinalizadas'=> $planificacionesFinalizadas, 'planificacionesPendientes'=> $planificacionesPendientes]);

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
