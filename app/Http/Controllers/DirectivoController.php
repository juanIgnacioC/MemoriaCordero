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

use App\Correccion;


class DirectivoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if($user->privilegioDocente($user['type']) ) {
            $correcciones = Correccion::docente($user['id']);
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

                $correccionesRealizadas = Correccion::docenteRealizadas($user['id']);

                return view('directivo.docente', ['correcciones'=> $correcciones, 'directivo'=> $directivo, 'correccionesRealizadas'=> $correccionesRealizadas]);
            }

            $correccionesRealizadas = Correccion::docenteRealizadas($user['id']);

            $obj = json_decode($correccionesRealizadas);
            //dd($obj[0]->idInstanciaUnidad);
            $correcciones2 = $obj[0];

            $idDirectivo = $correcciones2->idDirectivo;
            //dd($directivo);
            $directivo = User::where('id', $idDirectivo)
            ->first();

            return view('directivo.docente', ['correcciones'=> $correcciones, 'correccionesRealizadas'=> $correccionesRealizadas, 'directivo'=> $directivo]);
            
        }

        if($user->privilegioDirectivoExclusivo($user['type']) ) {

            $correcciones = Correccion::directivo($user['id']);
            //dd($correcciones);

            return view('directivo.directivo', ['correcciones'=> $correcciones]);
        }

        return view('errors.privilegios');
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
            $correcccionAntigua = Correccion::where('id', $correccionPrevia)
            ->first();
            //dd($correcccionAntigua);

            $correcccionAntigua->estado = "3";
            $correcccionAntigua->save();
            //Se corrige una revisión del directivo, estado: Solicita corrección
            $flujo = "3";
        }
        
        $correcccion = new Correccion([
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

        return redirect(route('planifications.contents', ['asignatura'=> $asignatura, 'curso'=> $curso, 'id'=> $instanciaUnidad]) );
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
            //dd($obj[0]->idInstanciaUnidad);
            $correcciones = $obj[0];
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
        $correcccionAntigua = Correccion::where('id', $idCorreccionAntigua)
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
        
        $correcccion = new Correccion([
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
