<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

use App\Establecimiento;
use App\Curso;
use App\InstanciaEstablecimiento;
use App\InstanciaEstablecimientoAlumno;


class AdministradorController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	return view('admin.index');
    }

    public function users()
    {
        $user = Auth::user();
        if($user->privilegioAdministrador($user['type']) ) {

            $users = User::all();

            return view('admin.users', ['users'=> $users]);
        }
        return view('errors.privilegios');
    }

    public function guardarCambios(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required',
            'email'=>'required',
            'type' =>'required'
        ]);

        $id = $request->get('id');
        $name = $request->get('name');
        $email = $request->get('email');
        $type = $request->get('type');

        $user = User::where('id', $id)
        ->first();

        $user->name = $name;
        $user->email = $email;
        $user->type = $type;

        $user->save();

        $users = User::all();
        return view('admin.users', ['users'=> $users]) ;
    }       


    public function establecimientos(Request $request)
    {
        $request->validate([
            'idUsuario' =>'required'
        ]);
        $idUsuario = $request->get('idUsuario');

        $user = User::where('id', $idUsuario)
        ->first();

        $establecimientos = Establecimiento::all();

        $instEstablecimientos = InstanciaEstablecimiento::obtenerInstancias($idUsuario);

        $fecha = date('Y-m-d');

        return view('admin.establecimientos', ['establecimientos'=> $establecimientos, 'user'=> $user, 'instEstablecimientos'=> $instEstablecimientos,'fecha'=> $fecha]);
    }

    public function createInstanciaEstablecimiento(Request $request)
    {
        $request->validate([
            'idDocente'=>'required',
            'establecimiento'=>'required',
            'fecha'=>'required'
        ]);

        //Datos crear InstanciaPlaniAño
        $idDocente = $request->get('idDocente');
        $establecimiento = $request->get('establecimiento');
        $fecha = $request->get('fecha');


        $instanciaEstablecimiento = new InstanciaEstablecimiento([
            'idDocente' => $idDocente,
            'idEstablecimiento' => $establecimiento,
            'fecha' => $fecha
        ]);

        $instanciaEstablecimiento->save();


        //return view('forms.planifications');
        //return redirect(route('forms.validation', ['instanciaPlani', $instanciaPlani]));
        return redirect(route('admin.users'));

    }    

    public function establecimientosAlumno(Request $request)
    {
        $request->validate([
            'idUsuario' =>'required'
        ]);
        $idUsuario = $request->get('idUsuario');

        $user = User::where('id', $idUsuario)
        ->first();

        $establecimientos = Establecimiento::all();
        $cursos = Curso::all();

        $instEstablecimientos = InstanciaEstablecimientoAlumno::obtenerInstancias($idUsuario);

        $fecha = date('Y-m-d');

        return view('admin.establecimientosAlumno', ['establecimientos'=> $establecimientos, 'cursos'=> $cursos, 'user'=> $user, 'instEstablecimientos'=> $instEstablecimientos,'fecha'=> $fecha]);
    }

    public function createInstanciaEstablecimientoAlumno(Request $request)
    {
        $request->validate([
            'idAlumno'=>'required',
            'establecimiento'=>'required',
            'fecha'=>'required'
        ]);

        //Datos crear InstanciaPlaniAño
        $idAlumno = $request->get('idAlumno');
        $establecimiento = $request->get('establecimiento');
        $fecha = $request->get('fecha');
        $curso = $request->get('curso');
        $indice = $request->get('indice');
        $type = $request->get('type');


        $InstanciaEstablecimientoAlumno = new InstanciaEstablecimientoAlumno([
            'idAlumno' => $idAlumno,
            'idEstablecimiento' => $establecimiento,
            'fecha' => $fecha,
            'curso' => $curso,
            'indice' => $indice,
            'type' => $type,
        ]);
        //dd($InstanciaEstablecimientoAlumno);
        $InstanciaEstablecimientoAlumno->save();


        //return view('forms.planifications');
        //return redirect(route('forms.validation', ['instanciaPlani', $instanciaPlani]));
        return redirect(route('admin.users'));

    } 

}
