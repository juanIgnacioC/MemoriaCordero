<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Asignatura;
use App\Curso;
use App\InstanciaPlaniAño;
use App\Unidad;
use App\InstanciaUnidad;
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
        if($user->privilegioDocente($user['type']) ) {
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
        return view('errors.privilegios');
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
            'Periodo'=>'required',
            'NuevoNombre'=>'required',
            'NuevoNumero'=>'required',
            'fechaInicio' =>'required',
            'fechaTermino'=>'required',
            'idInstanciaPlaniAño'=>'required',
            'objetivoGeneral'=>'required'
        ]);

        //Datos crear InstanciaPlaniAño
        $Periodo = $request->get('Periodo');

        $NuevoNombre = $request->get('NuevoNombre');
        $idUnidadFK = $request->get('idUnidadFK');

        //dump($idUnidadFK);
        //dump($NuevoNombre);
        
        $fechaInicio = $request->get('fechaInicio');
        $fechaTermino = $request->get('fechaTermino');
        //cast format
        $fechaInicio = date('Y-m-d', strtotime($fechaInicio));
        $fechaTermino = date('Y-m-d', strtotime($fechaTermino));

        $NuevoNumero = $request->get('NuevoNumero');
        $idInstanciaPlaniAño = $request->get('idInstanciaPlaniAño');
        
        $objetivoGeneral = $request->get('objetivoGeneral');
        //dump($objetivoGeneral);

        $InstanciaUnidad = new InstanciaUnidad([
            'Periodo' => $Periodo,
            'NuevoNombre' => $NuevoNombre,
            'NuevoObjetivoGeneral' => $objetivoGeneral,
            'NuevoNumero' => $NuevoNumero,
            'fechaInicio' => $fechaInicio,
            'fechaTermino' => $fechaTermino,
            'idInstanciaPlaniAño' => $idInstanciaPlaniAño,
            'idUnidadFK' => $idUnidadFK
        ]);

        //dump($InstanciaUnidad);

        $InstanciaUnidad->save();

        //retornar a vista vista unidades
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        //dump($curso);
        //dump($asignatura);

        //return redirect(route('forms.planifications'));
        
        //return view('planifications.unidades', ['idInstanciaPlaniAño'=> $idInstanciaPlaniAño, 'curso'=> $curso, 'asignatura'=> $asignatura]);

        return redirect(route('planifications.unidades', ['asignatura'=> $asignatura, 'curso' => $curso, 'idInstanciaPlaniAño'=> $idInstanciaPlaniAño]) );
    }

    public function validationEx(Request $request)
    {
    	$request->validate([
            'anio'=>'required',
            'curso'=>'required',
            'asignatura'=>'required',
            'idInstanciaPlaniAño' =>'required'
        ]);
        //dump("llega a validation");

        //Datos crear InstanciaPlaniAño
        $anio = $request->get('anio');
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $idInstanciaPlaniAño = $request->get('idInstanciaPlaniAño');

        $instanciaPlani = InstanciaPlaniAño::where('id', $idInstanciaPlaniAño)
        ->first();
            /*->where('idAsignatura', $asignatura)
            ->first();*/

        //dump($instanciaPlani);

        /*$html = view('forms.validation')->with(compact('instanciaPlani'))->render();
        dump($html);
        return response()->json(['html' => $html]);*/

        //viendo este
        /*$response = array('status' =>'success','plani' => $instanciaPlani);
        return response()->json($response);*/

        //return response()->json(['plani' => $instanciaPlani]);

        //return response()->json(['url'=>url('/loadDashboard')])

        //return view('forms.validation', ['instanciaPlani'=> $instanciaPlani]);
        return view('forms.validation');
        //return redirect(route('forms.validation', ['instanciaPlani', $instanciaPlani]));
    }

    public function validation(Request $request)
    {
        $request->validate([
            'curso'=>'required',
            'asignatura'=>'required',
            'idInstanciaPlaniAño' =>'required'
        ]);
        //dump("llega a validation");

        //Datos get InstanciaPlaniAño
        $curso = $request->get('curso');
        $asignatura = $request->get('asignatura');
        $idInstanciaPlaniAño = $request->get('idInstanciaPlaniAño');

        $instanciaPlani = InstanciaPlaniAño::where('id', $idInstanciaPlaniAño)
        ->first();

        //dd($instanciaPlani->idRepositorio);
        $unidades = Unidad::where('idRepositorio', $instanciaPlani->idRepositorio)
        ->orderBy('numero', 'asc')
        ->get();

        //dump($instanciaPlani);
        //dump($unidades);


        return view('forms.validation', ['instanciaPlani'=> $instanciaPlani, 'curso'=> $curso, 'asignatura'=> $asignatura, 'unidades'=> $unidades]);
        //return view('forms.validation');
        //return redirect(route('forms.validation', ['instanciaPlani', $instanciaPlani]));
    }

    public function wizard()
    {
    	return view('forms.wizard');
    }
}
