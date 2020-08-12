<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\InstanciaUnidad;
use App\InstanciaUnidadHabilidad;
use App\InstanciaUnidadActitud;
use App\InstanciaUnidadObjetivo;

use App\InstanciaClase;

use App\IndicadorUnidad;

class AddonsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index2()
    {
    	return view('addons.index2');
    }

    public function gallery()
    {
    	return view('addons.gallery');
    }

    public function calendar()
    {
    	return view('addons.calendar');
    }

    public function calendarUnidad(Request $request)
    {
        $request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'id' =>'required'
        ]);
        #dump("llega a calendarUnidad");

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
        #dd($dataPlaniUnidad);

        //instanciaClase
        $clases = InstanciaClase::where('idInstanciaUnidad', $instanciaUnidad->id)
        ->get();
        //dd($clases);

        $indicadorClases = IndicadorUnidad::moderarIndicadorUnidad($instanciaUnidad->id, $instanciaUnidad->idUnidadFK, 'clases', $clases, 1);
        dump($indicadorClases);

        return view('addons.calendarUnidad', ['curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidad'=> $instanciaUnidad, 'habilidades'=> $habilidades, 'actitudes'=> $actitudes, 'dataPlaniUnidad'=> $dataPlaniUnidad, 'clases'=> $clases, 'indicadorClases'=> $indicadorClases]);
    }

    public function createClase(Request $request)
    {
        $request->validate([
            'start'=>'required',
            'title'=>'required',
            'description'=>'required',
            'allDay'=>'required',
            'idInstanciaUnidad'=>'required',
            'idInstanciaUnidadObjetivo'=>'required',
            

        ]);
        //dump("create Objectives");

        //$json = $request->get('Conocimientosjson');
        //$json2 = $request->get('Indicadoresjson');

        $idInstanciaUnidad = $request->get('idInstanciaUnidad');
        $start = $request->get('start');
        $end = $request->get('end');
        $title = $request->get('title');
        $allDay = $request->get('allDay');

        //$idFc = $request->get('idFc');
        //dump($nombreObjetivo);
        $idInstanciaUnidadObjetivo = $request->get('idInstanciaUnidadObjetivo');
        $description = $request->get('description');

        //guardar objetivos
        $InstanciaClase = new InstanciaClase([
            'start' => $start,
            'end' => $end,
            'title' => $title,
            'description' => $description,
            'allDay' => $allDay,
            'idInstanciaUnidad' => $idInstanciaUnidad,
            'idInstanciaUnidadObjetivo' => $idInstanciaUnidadObjetivo
            ]);
        //dd($InstanciaClase);
        dump($InstanciaClase);
        $InstanciaClase->save();

        //retornar a vista vista calendar
        /*$curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        //dump($curso);
        //dump($asignatura);
        //dump($instanciaUnidad);

        //instancias habilidades y actitudes
        $habilidades = InstanciaUnidadHabilidad::obtener($instanciaUnidad->id);
        //dump($habilidades);

        $actitudes = InstanciaUnidadActitud::obtener($instanciaUnidad->id);
        //dump($actitudes);

        //instancias dataPlaniUnidad
        $dataPlaniUnidad = InstanciaUnidadObjetivo::dataPlaniUnidad($instanciaUnidad->id);

        return view('addons.calendarUnidad', ['curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidad'=> $instanciaUnidad, 'habilidades'=> $habilidades, 'actitudes'=> $actitudes, 'dataPlaniUnidad'=> $dataPlaniUnidad]);*/
    }

    public function updateClase(Request $request)
    {
        $request->validate([
            'idInstanciaClase'=>'required',
            'start'=>'required',
            'title'=>'required',
            'description'=>'required',
            'allDay'=>'required',
            'idInstanciaUnidad'=>'required',
            'idInstanciaUnidadObjetivo'=>'required',
            

        ]);
        //dump("create Objectives");

        //$json = $request->get('Conocimientosjson');
        //$json2 = $request->get('Indicadoresjson');

        $start = $request->get('start');
        $end = $request->get('end');
        $title = $request->get('title');
        $description = $request->get('description');
        $allDay = $request->get('allDay');
        $idInstanciaUnidad = $request->get('idInstanciaUnidad');
        $idInstanciaUnidadObjetivo = $request->get('idInstanciaUnidadObjetivo');

        //actualizar Clase
        $idInstanciaClase = $request->get('idInstanciaClase');
        $claseAntigua = InstanciaClase::where('id', $idInstanciaClase)
        ->first();

        $claseAntigua->start = $start;
        if($end != "null"){
            $claseAntigua->end = $end;
        }
        $claseAntigua->title = $title;
        $claseAntigua->description = $description;
        $claseAntigua->allDay = $allDay;
        $claseAntigua->idInstanciaUnidad = $idInstanciaUnidad;
        $claseAntigua->idInstanciaUnidadObjetivo = $idInstanciaUnidadObjetivo;
        dump($claseAntigua);
        $claseAntigua->save();
    }

    public function updateClaseTime(Request $request)
    {
        $request->validate([
            'idInstanciaClase'=>'required',
            'start'=>'required',
            'end'=>'required'            

        ]);

        $start = $request->get('start');
        $end = $request->get('end');

        //actualizar Clase
        $idInstanciaClase = $request->get('idInstanciaClase');
        $claseAntigua = InstanciaClase::where('id', $idInstanciaClase)
        ->first();

        $claseAntigua->start = $start;
        if($end != "null"){
            $claseAntigua->end = $end;
        }
        dump($claseAntigua);
        $claseAntigua->save();
    }

    public function updateClaseDetail(Request $request)
    {
        $request->validate([
            'idInstanciaClase'=>'required'           

        ]);

        $contenidos = $request->get('contenidos');
        $recursos = $request->get('recursos');
        $inicio = $request->get('inicio');
        $desarrollo = $request->get('desarrollo');
        $cierre = $request->get('cierre');

        //actualizar Clase Detail
        $idInstanciaClase = $request->get('idInstanciaClase');
        $claseAntigua = InstanciaClase::where('id', $idInstanciaClase)
        ->first();

        if($contenidos != ""){
            $claseAntigua->contenidos = $contenidos;
        }
        if($recursos != ""){
            $claseAntigua->recursos = $recursos;
        }
        if($inicio != ""){
            $claseAntigua->inicio = $inicio;
        }
        if($desarrollo != ""){
            $claseAntigua->desarrollo = $desarrollo;
        }
        if($cierre != ""){
            $claseAntigua->cierre = $cierre;
        }
        dump($claseAntigua);
        $claseAntigua->save();
    }

    public function deleteClase(Request $request)
    {
        $request->validate([
            'idInstanciaClase'=>'required'
        ]);

        //actualizar Clase
        $idInstanciaClase = $request->get('idInstanciaClase');
        $clase = InstanciaClase::where('id', $idInstanciaClase)
        ->first();

        $clase->delete();
    }

    public function invoice()
    {
    	return view('addons.invoice');
    }

    public function chat()
    {
    	return view('addons.chat');
    }
}
