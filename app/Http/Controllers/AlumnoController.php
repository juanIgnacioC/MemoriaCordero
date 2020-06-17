<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

use App\Establecimiento;
use App\InstanciaEstablecimiento;

use App\InstanciaPlaniAño;
use App\InstanciaUnidad;
use App\InstanciaUnidadObjetivo;

use App\InstanciaEstablecimientoAlumno;
use App\CorreccionAlumno;


class AlumnoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if($user->privilegioDocenteExclusivo($user['type']) ) {
            /*$correcciones = CorreccionAlumno::docente($user['id']);
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

                $correccionesRealizadas = CorreccionAlumno::docenteRealizadas($user['id']);

                return view('alumno.docente', ['correcciones'=> $correcciones, 'directivo'=> $directivo, 'correccionesRealizadas'=> $correccionesRealizadas]);
            }

            $correccionesRealizadas = CorreccionAlumno::docenteRealizadas($user['id']);

            $obj = json_decode($correccionesRealizadas);
            //dd($obj[0]->idInstanciaUnidad);
            $correcciones2 = $obj[0];

            $idDirectivo = $correcciones2->idDirectivo;
            //dd($directivo);
            $directivo = User::where('id', $idDirectivo)
            ->first();*/

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

            return view('alumno.docente', ['instanciasPlaniAño'=> $instanciasPlaniAño, 'establecimientos'=> $establecimientos, 'anios'=> $anios]);

            //return view('alumno.docente', ['correcciones'=> $correcciones, 'correccionesRealizadas'=> $correccionesRealizadas, 'directivo'=> $directivo]);
            
        }

        if(!$user->privilegioAlumnoExclusivo($user['type']) ) {
            $correcciones = CorreccionAlumno::directivo($user['id']);
            $correccionesRealizadas = CorreccionAlumno::directivoRealizadas($user['id']);

            return view('alumno.alumno', ['correcciones'=> $correcciones, 'correccionesRealizadas'=> $correccionesRealizadas]);
        }

        if($user->privilegioDirectivoExclusivo($user['type']) ) {

            $correcciones = CorreccionAlumno::directivo($user['id']);
            $correccionesRealizadas = CorreccionAlumno::directivoRealizadas($user['id']);

            return view('alumno.directivo', ['correcciones'=> $correcciones, 'correccionesRealizadas'=> $correccionesRealizadas]);
        }

        if($user->privilegioAdministrador($user['type']) ) {

            $correcciones = CorreccionAlumno::administrador();
            $correccionesRealizadas = CorreccionAlumno::administradorRealizadas();

            return view('alumno.administrador', ['correcciones'=> $correcciones, 'correccionesRealizadas'=> $correccionesRealizadas]);
        }

        return view('errors.privilegios');
    }

    //Docente ve planificaciones para asignar alumnos
    public function planificationAlumno(Request $request)
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

        //$instanciaPlani = InstanciaPlaniAño::where('id', $idInstanciaPlaniAño)
        //->first();

        //Modelo insplanianio para obtener alumnos de este curso
        $instanciaPlani = InstanciaPlaniAño::obtenerDataAlumnos($idInstanciaPlaniAño);
        dump($instanciaPlani);

        //Modelo InstanciaEstablecimientoAlumno para obtener los alumnos asignados a esta instancia de curso
        $alumnos = InstanciaEstablecimientoAlumno::obtenerAlumnos($instanciaPlani->idEstablecimiento, $instanciaPlani->idCurso, $instanciaPlani->indice, $instanciaPlani->anio);
        //dd($alumnos);

        //alumnos ya asignados HACER
        //$instAlumnos = InstanciaEstablecimientoAlumno::obtenerInstancias($idUsuario);

        //dd($instanciaPlani->idRepositorio);
        //$unidades = Unidad::where('idRepositorio', $instanciaPlani->idRepositorio)->get();

        //dump($instanciaPlani);
        //dump($instanciaUnidades);
        //dump($unidades);

        return view('alumno.asignar', ['instanciaPlani'=> $instanciaPlani, 'curso'=> $curso, 'asignatura'=> $asignatura, 'alumnos'=> $alumnos]);
        //return view('alumno.asignar', ['instanciaPlani'=> $instanciaPlani, 'curso'=> $curso, 'asignatura'=> $asignatura, 'alumnos'=> $alumnos, 'instAlumnos'=> $instAlumnos]);

        //return view('planifications.unidades');
    }

    public function solicitar(Request $request)
    {
        $request->validate([
            'idInstanciaUnidad'=>'required',
            'curso'=>'required',
            'asignatura'=>'required'
        ]);

        $user = Auth::user();
        if($user->privilegioDocente($user['type']) ) {

            $idInstanciaUnidad = $request->get('idInstanciaUnidad');
            $curso = $request->get('curso');
            $asignatura = $request->get('asignatura');

            $instanciaUnidad = InstanciaUnidad::where('id', $idInstanciaUnidad)
            ->first();

            $instanciaPlaniAño = InstanciaPlaniAño::where('id', $instanciaUnidad->idInstanciaPlaniAño)
            ->first();

            //dump($instanciaPlaniAño);

            $anio = $instanciaPlaniAño->anio;
            //dump($anio);

            $instanciasEstablecimiento = InstanciaEstablecimiento::where('id', $instanciaPlaniAño->idInstanciaEstablecimiento)
            ->first();

            $directivo = InstanciaEstablecimiento::obtenerDirectivo($instanciasEstablecimiento->idEstablecimiento);

            $correccion = $request->get('correccion');
            //dd($correccion);

            //Si se solicita una corrección desde una revisión se agrega $correccion
            return view('directivo.solicitar', ['instanciaUnidad'=> $instanciaUnidad, 'curso'=> $curso, 'asignatura'=> $asignatura, 'user'=> $user, 'anio'=> $anio, 'directivo'=> $directivo, 'correccionPrevia'=> $correccion]);
        }
        
    }

    public function solicitarCorreccion(Request $request)
    {
        $request->validate([
            'idInstanciaUnidad'=>'required'
        ]);

        $idDocente = $request->get('idDocente');
        $idInstanciaUnidad = $request->get('idInstanciaUnidad');
        $asignatura = $request->get('asignatura');
        $curso = $request->get('curso');
        $anio = $request->get('anio');
        $correcciones = $request->get('correcciones');
        $estado = $request->get('estado');
        $idUsuario = $request->get('idUser');
        $idDirectivo = $request->get('idDirectivo');
        //Se inicia una solicitud de corrección, estado: inicio corrección
        $flujo = "1";

        //Se finaliza la correccion previa
        $correccionPrevia = $request->get('correccionPrevia');
        if($correccionPrevia != null){
            $correcccionAntigua = CorreccionAlumno::where('id', $correccionPrevia)
            ->first();
            //dd($correcccionAntigua);

            $correcccionAntigua->estado = "3";
            $correcccionAntigua->save();
            //Se corrige una revisión del directivo, estado: Solicita corrección
            $flujo = "3";
        }
        
        $correcccion = new CorreccionAlumno([
            'idDocente' => $idDocente,
            'idInstanciaUnidad' => $idInstanciaUnidad,
            'asignatura' => $asignatura,
            'curso' => $curso,
            'anio' => $anio,
            'correcciones' => $correcciones,
            'estado' => $estado,
            'idUsuario' => $idUsuario,
            'idDirectivo' => $idDirectivo,
            'flujo' => $flujo
        ]);
        //dd($correcccion);
        $correcccion->save();

        $instanciaUnidad = InstanciaUnidad::where('id', $idInstanciaUnidad)
        ->first();

        //return redirect(route('planifications.contents', ['asignatura'=> $asignatura, 'curso'=> $curso, 'id'=> $instanciaUnidad]) );
        return redirect(route('directivo.index'));
    }       


    public function revision(Request $request)
    {
        $request->validate([
            'correcciones'=>'required'
        ]);

        $user = Auth::user();
        if($user->privilegioDirectivoExclusivo($user['type']) ) {

            $correccionesJson = $request->get('correcciones');
            $obj = json_decode($correccionesJson);
            //dd($obj->idInstanciaUnidad);
            //dd($obj[0]->idInstanciaUnidad);
            $correcciones = $obj;
            //$correcciones = $obj[0];
            //dd($correcciones);

            $idInstanciaUnidad = $correcciones->idInstanciaUnidad;
            $curso = $correcciones->curso;
            $asignatura = $correcciones->asignatura;

            $instanciaUnidad = InstanciaUnidad::where('id', $idInstanciaUnidad)
            ->first();

            //dd($instanciaUnidad->id);


            $anio = $correcciones->anio;
            //dump($anio);

            $usuario = $correcciones->idUsuario;
            $directivo = $correcciones->idDirectivo;
            $idCorreccionAntigua = $correcciones->id;

            //return view('directivo.users', ['users'=> $users]);
        
        return redirect(route('directivo.revisionDirectivo', ['instanciaUnidad'=> $instanciaUnidad, 'curso'=> $curso, 'asignatura'=> $asignatura, 'user'=> $usuario, 'anio'=> $anio, 'directivo'=> $directivo, 'correccionesJson'=> $correccionesJson, 'idCorreccionAntigua'=> $idCorreccionAntigua]));
        }
    }

    public function revisionDirectivo(Request $request)
    {
        $request->validate([
            
        ]);

        $user = Auth::user();
        if($user->privilegioDirectivoExclusivo($user['type']) ) {

            $idInstanciaUnidad = $request->get('instanciaUnidad');

            $instanciaUnidad = InstanciaUnidad::where('id', $idInstanciaUnidad)
            ->first();

            $curso = $request->get('curso');
            $asignatura = $request->get('asignatura');
            $anio = $request->get('anio');;
            //dump($anio);

            $idUsuario = $request->get('user');
            $usuario = User::where('id', $idUsuario)
            ->first();

            $idDirectivo = $request->get('directivo');
            $directivo = User::where('id', $idDirectivo)
            ->first();

            $correccionesJson = $request->get('correccionesJson');
            $idCorreccionAntigua = $request->get('idCorreccionAntigua');


            //return view('directivo.users', ['users'=> $users]);
        
        return view('directivo.revision', ['instanciaUnidad'=> $instanciaUnidad, 'curso'=> $curso, 'asignatura'=> $asignatura, 'user'=> $usuario, 'anio'=> $anio, 'directivo'=> $directivo, 'correccionesJson'=> $correccionesJson, 'idCorreccionAntigua'=> $idCorreccionAntigua]);
        }
    }


    public function solicitarRevision(Request $request)
    {

        $idCorreccionAntigua = $request->get('idCorreccionAntigua');
        $correcccionAntigua = CorreccionAlumno::where('id', $idCorreccionAntigua)
        ->first();

        $correcccionAntigua->estado = "3";
        $correcccionAntigua->save();

        $idDocente = $request->get('idDocente');
        
        $idInstanciaUnidad = $request->get('idInstanciaUnidad');
        $asignatura = $request->get('asignatura');
        $curso = $request->get('curso');
        $anio = $request->get('anio');
        $correcciones = $request->get('correcciones');
        $estado = "2";
        $idUsuario = $request->get('idUser');
        $idDirectivo = $request->get('idDirectivo');

        $estadoPlani = $request->get('estadoPlani');
        if($estadoPlani == "true"){
            //Planificación aceptada, estado: Revisión final
            $flujo = "4";
        }
        else{
            //Planificación rechazada, estado: Revisada
            $flujo = "2";
        }
        
        //comprobar si es el final y usar flujo 4
        
        $correcccion = new CorreccionAlumno([
            'idDocente' => $idDocente,
            'idInstanciaUnidad' => $idInstanciaUnidad,
            'asignatura' => $asignatura,
            'curso' => $curso,
            'anio' => $anio,
            'correcciones' => $correcciones,
            'estado' => $estado,
            'idUsuario' => $idUsuario,
            'idDirectivo' => $idDirectivo,
            'flujo' => $flujo
        ]);
        //dd($correcccion);
        $correcccion->save();

        $instanciaUnidad = InstanciaUnidad::where('id', $idInstanciaUnidad)
        ->first();

        return redirect(route('directivo.index'));
    }     

}
