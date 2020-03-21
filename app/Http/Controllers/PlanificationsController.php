<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\InstanciaPlaniAño;
use App\InstanciaUnidad;

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

        //dd($instanciaPlani->idRepositorio);
        //$unidades = Unidad::where('idRepositorio', $instanciaPlani->idRepositorio)->get();

        dump($instanciaUnidad);
        //dump($unidades);


        return view('planifications.contents', ['curso'=> $curso, 'asignatura'=> $asignatura, 'instanciaUnidad'=> $instanciaUnidad]);

		//return view('planifications.unidades');
    }
}
