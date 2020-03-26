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

            return view('directivo.docente', ['correcciones'=> $correcciones]);
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

            //return view('directivo.users', ['users'=> $users]);
        }
        return view('directivo.solicitar', ['instanciaUnidad'=> $instanciaUnidad, 'curso'=> $curso, 'asignatura'=> $asignatura, 'user'=> $user, 'anio'=> $anio, 'directivo'=> $directivo]);
    }

    public function solicitarCorreccion(Request $request)
    {
        $request->validate([
            'idInstanciaUnidad'=>'required'
        ]);
        dump("solicitarCorreccion");

        $idDocente = $request->get('idDocente');
        $idInstanciaUnidad = $request->get('idInstanciaUnidad');
        $asignatura = $request->get('asignatura');
        $curso = $request->get('curso');
        $anio = $request->get('anio');
        $correcciones = $request->get('correcciones');
        $estado = $request->get('estado');
        $idUsuario = $request->get('idUser');
        $idDirectivo = $request->get('idDirectivo');

        
        $correcccion = new Correccion([
            'idDocente' => $idDocente,
            'idInstanciaUnidad' => $idInstanciaUnidad,
            'asignatura' => $asignatura,
            'curso' => $curso,
            'anio' => $anio,
            'correcciones' => $correcciones,
            'estado' => $estado,
            'idUsuario' => $idUsuario,
            'idDirectivo' => $idDirectivo
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


            $anio = $correcciones->anio;
            //dump($anio);

            $usuario = $correcciones->idUsuario;
            $directivo = $correcciones->idDirectivo;
            $idCorreccionAntigua = $correcciones->id;

            //return view('directivo.users', ['users'=> $users]);
        }
        return view('directivo.revision', ['instanciaUnidad'=> $instanciaUnidad, 'curso'=> $curso, 'asignatura'=> $asignatura, 'user'=> $usuario, 'anio'=> $anio, 'directivo'=> $directivo, 'correccionesJson'=> $correccionesJson, 'idCorreccionAntigua'=> $idCorreccionAntigua]);
    }


    public function solicitarRevision(Request $request)
    {

        dump("solicitarRevision");

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

        
        $correcccion = new Correccion([
            'idDocente' => $idDocente,
            'idInstanciaUnidad' => $idInstanciaUnidad,
            'asignatura' => $asignatura,
            'curso' => $curso,
            'anio' => $anio,
            'correcciones' => $correcciones,
            'estado' => $estado,
            'idUsuario' => $idUsuario,
            'idDirectivo' => $idDirectivo
        ]);
        //dd($correcccion);
        $correcccion->save();

        $instanciaUnidad = InstanciaUnidad::where('id', $idInstanciaUnidad)
        ->first();

        return redirect(route('planifications.contents', ['asignatura'=> $asignatura, 'curso'=> $curso, 'id'=> $instanciaUnidad]) );
    }     

}
