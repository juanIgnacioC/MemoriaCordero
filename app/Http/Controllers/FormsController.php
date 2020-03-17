<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Asignatura;
use App\Curso;
use App\InstanciaPlaniAño;
use App\Establecimiento;
use App\InstanciaEstablecimiento;
use App\RepositorioPlanificacion;


class FormsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function common()
    {
        $cursos = Curso::all();
        $asignaturas = Asignatura::all();
        //$establecimientos = Establecimiento::all();

        $user = Auth::user();
        $userId =  $user['id'];
        //HardCode Docente id
        //$userId = '1';

        //Join establecimiento instanciaEstablecimiento y docente
        $establecimientos = InstanciaEstablecimiento::obtenerInstancias($userId);
        
    	return view('forms.common',['asignaturas'=> $asignaturas, 'cursos'=> $cursos, 'establecimientos'=> $establecimientos]);
        //return view('forms.common', $asignaturas, $cursos);
    }

    public function planifications()
    {
        //Incluir parametros o hacer nuevo metodo
        $user = Auth::user();
        $userId =  $user['id'];

        //Join establecimiento instanciaEstablecimiento y docente/
        //dropdown seleccionar establecimiento y año
        $establecimientos = InstanciaEstablecimiento::obtenerInstancias($userId);
        $anios = InstanciaPlaniAño::obtenerAnios($establecimientos->get(0));

        //obtener instancias solo de los establecimientos del docente
        //$instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimiento($establecimientos);

        //obtener instancias solo del establecimiento y año seleccionado
        $instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimientoAnio($establecimientos->get(0), $anios->get(0));

        /*dump($instanciasPlaniAño);
        dump($establecimientos);
        dump($anios);*/

        return view('forms.planifications', ['instanciasPlaniAño'=> $instanciasPlaniAño, 'establecimientos'=> $establecimientos, 'anios'=> $anios]);
    }

    public function planificationsFilter(Request $request)
    {
        //Incluir parametros o hacer nuevo metodo
        $user = Auth::user();
        $userId =  $user['id'];

        $idEstablecimiento = $request->get('establecimientoFilter');
        $anio = $request->get('anioFilter');
        /*dump($request);
        dump($idEstablecimiento);
        dump($anio);*/

        //Join establecimiento instanciaEstablecimiento y docente/
        //dropdown seleccionar establecimiento y año
        $establecimientos = InstanciaEstablecimiento::obtenerInstancias($userId);
        $anios = InstanciaPlaniAño::obtenerAnios($establecimientos->get(0));

        //obtener instancias solo de los establecimientos del docente
        //$instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimiento($establecimientos);

        //obtener instancias solo del establecimiento y año seleccionado
        $instanciasPlaniAño = InstanciaPlaniAño::obtenerPlanificacionesEstablecimientoAnioId($idEstablecimiento, $anio);

        return view('forms.planifications', ['instanciasPlaniAño'=> $instanciasPlaniAño, 'establecimientos'=> $establecimientos, 'anios'=> $anios, 'establecimientoFilter' => $idEstablecimiento, 'anioFilter' => $anio]);
        //return redirect(route('forms.planifications', ['instanciasPlaniAño'=> $instanciasPlaniAño, 'establecimientos'=> $establecimientos, 'anios'=> $anios, 'establecimientoFilter' => $idEstablecimiento, 'anioFilter' => $anio]));
    }

    public function createPlaniAnio(Request $request)
    {
        $request->validate([
            'anio'=>'required',
            'curso'=>'required',
            'asignatura'=>'required',
            'establecimiento' =>'required'
        ]);

        //Datos crear InstanciaPlaniAño
        $anio = $request->get('anio');
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $establecimiento = $request->get('establecimiento');

        $repositorio = RepositorioPlanificacion::where('idCurso', $curso)
            ->where('idAsignatura', $asignatura)
            ->first();

            //dd($repositorio);


        $instanciaPlani = new InstanciaPlaniAño([
            'anio' => $anio,
            'idInstanciaEstablecimiento' => $establecimiento,
            'idRepositorio' => $repositorio['id']
        ]);

        $instanciaPlani->save();



        //return view('forms.planifications');
        //return redirect(route('forms.validation', ['instanciaPlani', $instanciaPlani]));
        return redirect(route('forms.planifications'));
    }

    public function createPlaniUnidad(Request $request)
    {
        $request->validate([
            'anio'=>'required',
            'curso'=>'required',
            'asignatura'=>'required',
            'establecimiento' =>'required'
        ]);

        //Datos crear InstanciaPlaniAño
        $anio = $request->get('anio');
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $establecimiento = $request->get('establecimiento');

        $repositorio = RepositorioPlanificacion::where('idCurso', $curso)
            ->where('idAsignatura', $asignatura)
            ->first();

            //dd($repositorio);


        $instanciaPlani = new InstanciaPlaniAño([
            'anio' => $anio,
            'idInstanciaEstablecimiento' => $establecimiento,
            'idRepositorio' => $repositorio['id']
        ]);

        $instanciaPlani->save();


        return view('forms.validation', ['instanciaPlani'=> $instanciaPlani]);
        //return redirect(route('forms.validation', ['instanciaPlani', $instanciaPlani]));
    }

    public function validation()
    {
    	return view('forms.validation');
    }

    public function wizard()
    {
    	return view('forms.wizard');
    }
}
