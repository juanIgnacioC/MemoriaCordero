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

use App\Correccion;
use App\Retroalimentacion;


class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$user = Auth::user();

        if($user->privilegioDocenteExclusivo($user['type']) ){
            /////Indicadores dashboard////
            $indicadorPlanificaciones = new Collection();

            $establecimientos = InstanciaEstablecimiento::obtenerInstancias($user['id']);
            $anios = InstanciaPlaniAño::obtenerAnios($establecimientos->get(0));
            

            $instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimientoAnio($establecimientos->get(0), $anios->get(0));

            $indicadorPlaniAnio = new Collection();
            $indicadorPlaniAnioClases = new Collection();
            $clasesRecientes = new Collection();

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
                //////////dump($dataClases);
                //$collection->put('price', 100);
                $indicadorPlaniAnio->push($avgUnidades); //Ingreso directo->avg

                $indicadorPlaniAnioClases->push($dataClases->avg('avgRetroUnidad') );

                /*if(count($dataClases) > 0){
                    $clasesR = Retroalimentacion::retroalimentacionesRecientes($planiAnio->id, $user['id']);
                }

                if(!$clasesR->isEmpty())
                    $clasesRecientes->push($clasesR);*/ // clases recientes por planiAño
            }
            //Retroalimentaciones recientes por docente
            $clasesRecientesDoc = Retroalimentacion::retroalimentacionesRecientesDocente($user['id']);

            dd($clasesRecientesDoc);
            //dd($clasesRecientes);  //cambiar por metodo retros fecha
            
            //Cálculo final para el dashboard
            ///dump($indicadorPlaniAnio); //AVG plani
            ///dump($indicadorPlaniAnioClases); //AVG retros
            ////dd($avgPlanificaciones);

            $avgPlanificaciones = $indicadorPlaniAnio->avg();
            $avgPlanificaciones = $avgPlanificaciones*20; //Igualdad a porcentaje
            $avgPlanificaciones = round($avgPlanificaciones); //round to decimal
            
            $totalPlani = count($indicadorPlaniAnio); //N° de planificaciones


            ////Indicador correcciones utp/////
            $correcciones = Correccion::docente($user['id']);
            $directivo = "";
            //dd($correcciones);
            if(!$correcciones->isEmpty()){
                $obj = json_decode($correcciones);
                //dd($obj[0]->idInstanciaUnidad);
                $correcciones2 = $obj[0];

                $idDirectivo = $correcciones2->idDirectivo;
                //dd($directivo);
                $directivo = User::where('id', $idDirectivo)
                ->first();
                //dd($directivo);

                //$correccionesRealizadas = Correccion::docenteRealizadas($user['id']);
            }
            //Cruce entre terminadas y espera corrección
            $totalCorrecciones = count($correcciones);
            $correccionesListas = $totalCorrecciones;

            foreach ($correcciones as $correccion) {
                if($correccion['flujo'] != "4"){
                    $correccionesListas = $correccionesListas - 1;
                }
            }

            //dump($correccionesListas);
            //porcentaje correcciones listas
            if($totalCorrecciones != 0)
                $avgCorrecciones = $correccionesListas / $totalCorrecciones * 100;
            else
                $avgCorrecciones = 0;
            //dump($avgCorrecciones);


            //Indicador Retroalimentaciones
            $avgRetroUnidad = $indicadorPlaniAnioClases->avg();
            $avgRetroUnidad = $avgRetroUnidad*20; //Igualdad a porcentaje
            $avgRetroUnidad = round($avgRetroUnidad); //round to decimal
            //dump($avgRetroUnidad);

    		return view('dashboard.docente', ['avgPlanificaciones'=> $avgPlanificaciones, 'totalPlani'=> $totalPlani, 'avgCorrecciones'=> $avgCorrecciones,'correcciones'=> $correcciones, 'totalCorrecciones'=> $totalCorrecciones, 'directivo'=> $directivo, 'avgRetroUnidad'=> $avgRetroUnidad]);
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
