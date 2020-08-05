<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\User;


use App\InstanciaEstablecimiento;
use App\InstanciaPlaniAño;
use App\InstanciaUnidad;
use App\IndicadorUnidad;


class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$user = Auth::user();
        $userId =  $user['id'];

        if($user->privilegioDocenteExclusivo($user['type']) ){
            /////Indicadores dashboard////
            $indicadorPlanificaciones = new Collection();

            $establecimientos = InstanciaEstablecimiento::obtenerInstancias($userId);
            $anios = InstanciaPlaniAño::obtenerAnios($establecimientos->get(0));
            

            $instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimientoAnio($establecimientos->get(0), $anios->get(0));

            $indicadorPlaniAnio = new Collection();
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
                $indicadorPlaniAnio->push($avgUnidades); //Ingreso directo->avg
            }
            //Cálculo final para el dashboard
            ////dump($indicadorPlaniAnio);
            ////dd($avgPlanificaciones);

            $avgPlanificaciones = $indicadorPlaniAnio->avg();
            $avgPlanificaciones = $avgPlanificaciones*20; //Igualdad a porcentaje
            $avgPlanificaciones = round($avgPlanificaciones, 2); //round to 2decimal




    		return view('dashboard.docente', ['avgPlanificaciones'=> $avgPlanificaciones]);
    	}
        elseif($user->privilegioDirectivoExclusivo($user['type']) ){
            return view('dashboard.directivo');
        }
    	elseif ($user->privilegioAlumnoExclusivo($user['type']) ){
            return view('dashboard.alumno');
        }
        elseif ($user->privilegioAdministrador($user['type']) ){
            return view('dashboard.index');
        }

    	return view('errors.privilegios');
    }
}
