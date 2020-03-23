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
        dump("llega a planification unidades");

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

        dump($instanciaPlani);
        dump($instanciaUnidades);
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
        dump("llega a contents unidad");

        //Datos get InstanciaPlaniAño
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $id = $request->get('id');

        $instanciaUnidad = InstanciaUnidad::where('id', $id)
        ->first();

        dump($instanciaUnidad);


        //instancias habilidades y actitudes
        $habilidades = InstanciaUnidadHabilidad::obtener($instanciaUnidad->id);
        dump($habilidades);

        $actitudes = InstanciaUnidadActitud::obtener($instanciaUnidad->id);
        dump($actitudes);

        return view('planifications.contents', ['curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidad'=> $instanciaUnidad, 'habilidades'=> $habilidades, 'actitudes'=> $actitudes]);
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
        dump("llega a contents unidad habilidades");

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

        dump($habilidades);


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
        dump($obj);
        foreach ($obj as $NuevoNombre) {
            dump($NuevoNombre);

            $InstanciaUnidadHabilidad = new InstanciaUnidadHabilidad([
            'NuevoNombre' => $NuevoNombre,
            'idInstanciaUnidad' => $instanciaUnidad->id
            ]);

            dump($InstanciaUnidadHabilidad);

            $InstanciaUnidadHabilidad->save();

        }

        //retornar a vista vista unidad
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        dump($curso);
        dump($asignatura);

        return redirect(route('planifications.contents', ['asignatura'=> $asignatura, 'curso'=> $curso, 'id'=> $instanciaUnidad]) );
    }


    public function attitudes(Request $request)
    {   
        $request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'id' =>'required'
        ]);
        dump("llega a contents unidad actitudes");

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

        dump($actitudes);

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
        dump($obj);
        foreach ($obj as $NuevoNombre) {
            dump($NuevoNombre);

            $InstanciaUnidadActitud = new InstanciaUnidadActitud([
            'NuevoNombre' => $NuevoNombre,
            'idInstanciaUnidad' => $instanciaUnidad->id
            ]);

            dump($InstanciaUnidadActitud);

            $InstanciaUnidadActitud->save();

        }

        //retornar a vista vista unidad
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        dump($curso);
        dump($asignatura);

        return redirect(route('planifications.contents', ['asignatura'=> $asignatura, 'curso'=> $curso, 'id'=> $instanciaUnidad]) );
    }
}
