<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\InstanciaPlaniAño;
use App\InstanciaUnidad;

use App\Habilidad;
use App\UnidadHabilidad;
use App\InstanciaUnidadHabilidad;

use App\Actitud;
use App\UnidadActitud;
use App\InstanciaUnidadActitud;

use App\Objetivo;
use App\UnidadObjetivo;

use App\ConocimientoPrevio;
use App\SubEje;
use App\Indicador;

use App\InstanciaObjetivo;
use App\InstanciaUnidadObjetivo;
use App\InstanciasConocimientoPrevio;
use App\InstanciaIndicador;
use App\InstanciaActividad;
use App\InstanciaEvaluacion;

class PlanificationsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)
    {	
    	$request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'idInstanciaPlaniAño' =>'required'
        ]);
        //dump("llega a planification unidades");

        //Datos get InstanciaPlaniAño
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $idInstanciaPlaniAño = $request->get('idInstanciaPlaniAño');

        $instanciaPlani = InstanciaPlaniAño::where('id', $idInstanciaPlaniAño)
        ->first();

        $instanciaUnidades = InstanciaUnidad::where('idInstanciaPlaniAño', $instanciaPlani->id)
        ->get();

        //dd($instanciaPlani->idRepositorio);
        //$unidades = Unidad::where('idRepositorio', $instanciaPlani->idRepositorio)->get();

        //dump($instanciaPlani);
        //dump($instanciaUnidades);
        //dump($unidades);


        return view('planifications.unidades', ['instanciaPlani'=> $instanciaPlani, 'curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidades'=> $instanciaUnidades]);

		//return view('planifications.unidades');
    }

    public function contents(Request $request)
    {	
    	$request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'id' =>'required'
        ]);
        //dump("llega a contents unidad");

        //Datos get InstanciaPlaniAño
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $id = $request->get('id');

        $instanciaUnidad = InstanciaUnidad::where('id', $id)
        ->first();

        //dump($instanciaUnidad);


        //instancias habilidades y actitudes
        $habilidades = InstanciaUnidadHabilidad::obtener($instanciaUnidad->id);
        //dump($habilidades);

        $actitudes = InstanciaUnidadActitud::obtener($instanciaUnidad->id);
        //dump($actitudes);

        //instancias dataPlaniUnidad
        $dataPlaniUnidad = InstanciaUnidadObjetivo::dataPlaniUnidad($instanciaUnidad->id);
        #dump($dataPlaniUnidad);

        return view('planifications.contents', ['curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidad'=> $instanciaUnidad, 'habilidades'=> $habilidades, 'actitudes'=> $actitudes, 'dataPlaniUnidad'=> $dataPlaniUnidad]);
        //return view('planifications.contents', ['curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidad'=> $instanciaUnidad, 'habilidades'=> $habilidades]);

		//return view('planifications.unidades');
    }

    public function abilities(Request $request)
    {   
        $request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'id' =>'required'
        ]);
        //dump("llega a contents unidad habilidades");

        //Datos get InstanciaUnidad y habilidades decode
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $id = $request->get('id');

        $instanciaUnidad = InstanciaUnidad::where('id', $id)
        ->first();

        //obtener datos repositorio
        //
        $instanciaPlani = InstanciaPlaniAño::where('id', $instanciaUnidad->idInstanciaPlaniAño)
        ->first();

        $idRepositorio = $instanciaPlani->idRepositorio;

        //habilidades con referencia a unidad de repositorio
        $idUnidad = $instanciaUnidad->idUnidadFK;

        $habilidades = UnidadHabilidad::obtenerHabilidades($idUnidad, $idRepositorio);
        //$actitudes = UnidadActitud::obtenerActitudes($idUnidad, $idRepositorio);

        //dump($habilidades);


        return view('planifications.habilities', ['curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidad'=> $instanciaUnidad, 'habilidades'=> $habilidades]);
    }

    public function createAbilities(Request $request)
    {
        $request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'Habilidadesjson'=>'required',
            'idInstanciaUnidad'=>'required'

        ]);

        $json = $request->get('Habilidadesjson');
        //pasar al json o eliminar de bd, no sirve de mucho
        $idHabilidadFK = $request->get('idHabilidadFK');
        $idInstanciaUnidad = $request->get('idInstanciaUnidad');

        $instanciaUnidad = InstanciaUnidad::where('id', $idInstanciaUnidad)
        ->first();

        //recorrer json con nombres de habilidades
        $obj = json_decode($json);
        //dump($obj);
        foreach ($obj as $NuevoNombre) {
            //dump($NuevoNombre);

            $InstanciaUnidadHabilidad = new InstanciaUnidadHabilidad([
            'NuevoNombre' => $NuevoNombre,
            'idInstanciaUnidad' => $instanciaUnidad->id
            ]);

            //dump($InstanciaUnidadHabilidad);

            $InstanciaUnidadHabilidad->save();

        }

        //retornar a vista vista unidad
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        //dump($curso);
        //dump($asignatura);

        return redirect(route('planifications.contents', ['asignatura'=> $asignatura, 'curso'=> $curso, 'id'=> $instanciaUnidad]) );
    }


    public function attitudes(Request $request)
    {   
        $request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'id' =>'required'
        ]);
        //dump("llega a contents unidad actitudes");

        //Datos get InstanciaUnidad y habilidades decode
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $id = $request->get('id');

        $instanciaUnidad = InstanciaUnidad::where('id', $id)
        ->first();

        //obtener datos repositorio
        //
        $instanciaPlani = InstanciaPlaniAño::where('id', $instanciaUnidad->idInstanciaPlaniAño)
        ->first();

        $idRepositorio = $instanciaPlani->idRepositorio;

        //habilidades con referencia a unidad de repositorio
        $idUnidad = $instanciaUnidad->idUnidadFK;

        $actitudes = UnidadActitud::obtenerActitudes($idUnidad, $idRepositorio);

        //dump($actitudes);

        return view('planifications.attitudes', ['curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidad'=> $instanciaUnidad, 'actitudes'=> $actitudes]);
    }

    public function createAttitudes(Request $request)
    {
        $request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'Actitudesjson'=>'required',
            'idInstanciaUnidad'=>'required'

        ]);

        $json = $request->get('Actitudesjson');
        //pasar al json o eliminar de bd, no sirve de mucho
        $idActitudFK = $request->get('idActitudFK');
        $idInstanciaUnidad = $request->get('idInstanciaUnidad');

        $instanciaUnidad = InstanciaUnidad::where('id', $idInstanciaUnidad)
        ->first();

        //recorrer json con nombres de habilidades
        $obj = json_decode($json);
        //dump($obj);
        foreach ($obj as $NuevoNombre) {
            //dump($NuevoNombre);

            $InstanciaUnidadActitud = new InstanciaUnidadActitud([
            'NuevoNombre' => $NuevoNombre,
            'idInstanciaUnidad' => $instanciaUnidad->id
            ]);

            //dump($InstanciaUnidadActitud);

            $InstanciaUnidadActitud->save();

        }

        //retornar a vista vista unidad
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        //dump($curso);
        //dump($asignatura);

        return redirect(route('planifications.contents', ['asignatura'=> $asignatura, 'curso'=> $curso, 'id'=> $instanciaUnidad]) );
    }


    public function objectives(Request $request)
    {   
        $request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'id' =>'required'
        ]);
        //dump("llega a contents unidad objetivos");

        //Datos get InstanciaUnidad y habilidades decode
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $id = $request->get('id');

        $instanciaUnidad = InstanciaUnidad::where('id', $id)
        ->first();

        //obtener datos repositorio
        //
        $instanciaPlani = InstanciaPlaniAño::where('id', $instanciaUnidad->idInstanciaPlaniAño)
        ->first();

        $idRepositorio = $instanciaPlani->idRepositorio;

        //habilidades con referencia a unidad de repositorio
        $idUnidad = $instanciaUnidad->idUnidadFK;

        $objetivos = UnidadObjetivo::obtenerObjetivos($idUnidad, $idRepositorio);
        #dump($objetivos);

        $subEjes = SubEje::obtenerSubEjes($objetivos);

        //dump($subEjes);

        $conocimientos = ConocimientoPrevio::obtenerConocimientos($idUnidad, $idRepositorio);
        //dump($conocimientos);

        $indicadores = Indicador::obtenerIndicadores($objetivos);
        //dump($indicadores);


        return view('planifications.objectives', ['curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidad'=> $instanciaUnidad, 'objetivos'=> $objetivos, 'subEjes'=> $subEjes,'conocimientos'=> $conocimientos,'indicadores'=> $indicadores]);
    }

    public function createObjectives(Request $request)
    {
        $request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'Conocimientosjson'=>'required',
            'Indicadoresjson'=>'required',
            'idInstanciaUnidad'=>'required',
            'nombreObjetivo'=>'required',
            'idUnidadObjetivo'=>'required',
            'subEje'=>'required'

        ]);
        //dump("create Objectives");

        $json = $request->get('Conocimientosjson');
        $json2 = $request->get('Indicadoresjson');

        $idInstanciaUnidad = $request->get('idInstanciaUnidad');
        $idSubEje = $request->get('subEje');

        $nombreObjetivo = $request->get('nombreObjetivo');
        //dump($nombreObjetivo);
        $idUnidadObjetivo = $request->get('idUnidadObjetivo');

        $instanciaUnidad = InstanciaUnidad::where('id', $idInstanciaUnidad)
        ->first();

        $idObj = $request->get('idObj');

        //dump($instanciaUnidad);

        //guardar objetivos
        $InstanciaObjetivo = new InstanciaObjetivo([
            'NuevoNombre' => $nombreObjetivo,
            'idSubEje' => $idSubEje,
            'idObj' => $idObj
            ]);
        //dump($InstanciaObjetivo);
        $InstanciaObjetivo->save();

        $InstanciaUnidadObjetivo = new InstanciaUnidadObjetivo([
            'idInstanciaUnidad' => $instanciaUnidad->id,
            'idInstanciaObjetivo' => $InstanciaObjetivo->id
            ]);
        //dd($InstanciaUnidadObjetivo);
        $InstanciaUnidadObjetivo->save();


        //recorrer json con nombres de conocimientos e indicadores
        $obj = json_decode($json);
        $obj2 = json_decode($json2);

        //InstanciasConocimientos
        foreach ($obj as $NuevoNombre) {
            $InstanciasConocimientoPrevio = new InstanciasConocimientoPrevio([
            'nuevoNombre' => $NuevoNombre,
            'idInstanciaUnidadObjetivo' => $InstanciaUnidadObjetivo->id
            ]);

            //dd($InstanciasConocimientoPrevio);

            $InstanciasConocimientoPrevio->save();
        }
        //Instancias Indicadores
        foreach ($obj2 as $NuevoNombre) {
            $InstanciaIndicador = new InstanciaIndicador([
            'nuevoNombre' => $NuevoNombre,
            'idInstanciaUnidadObjetivo' => $InstanciaUnidadObjetivo->id
            ]);

            //dd($InstanciaIndicador);

            $InstanciaIndicador->save();
        }

        //Instancia actividad
        $actividades = $request->get('actividades');
        if($actividades != null){
            $InstanciaActividad = new InstanciaActividad([
                'nombre' => $actividades,
                'idInstanciaUnidadObjetivo' => $InstanciaUnidadObjetivo->id
                ]);
            $InstanciaActividad->save();
        }

        //Instancia actividad
        $evaluacion = $request->get('evaluacion');
        if($evaluacion != null){
            $InstanciaEvaluacion = new InstanciaEvaluacion([
                'nombre' => $evaluacion,
                'idInstanciaUnidadObjetivo' => $InstanciaUnidadObjetivo->id
                ]);
            $InstanciaEvaluacion->save();
        }

        //retornar a vista vista unidad
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        //dump($curso);
        //dump($asignatura);

        return redirect(route('planifications.contents', ['asignatura'=> $asignatura, 'curso'=> $curso, 'id'=> $instanciaUnidad]) );
    }
}
