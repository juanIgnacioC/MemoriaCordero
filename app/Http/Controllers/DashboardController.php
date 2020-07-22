<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;


class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$user = Auth::user();

        if($user->privilegioDocenteExclusivo($user['type']) ){
    		return view('dashboard.docente');
    	}
        elseif($user->privilegioDirectivoExclusivo($user['type']) ){
            return view('dashboard.directivo');
        }
    	elseif ($user->privilegioAlumnoExclusivo($user['type']) ){
            return view('dashboard.alumno');
        }
        elseif ($user->privilegioAdministrador($user['type']) ){
            return view('dashboard.index');
        }

    	return view('errors.privilegios');
    }
}
