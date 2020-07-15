<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ChartsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$user = Auth::user();
        if($user->privilegioDocenteExclusivo($user['type']) ) {
        	//ver planificaciones docente y calculos

        	//Tabla intermedia Indicador? atribute updated?. tupla por unidad? ->de esto calcular general? (optimización?)
        	//Realizar cada vez
        }
    	return view('charts.index');
    }
}
