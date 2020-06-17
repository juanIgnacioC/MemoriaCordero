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

        if(!$user->privilegioAlumnoExclusivo($user['type']) ) {
    		return view('dashboard.index');
    	}
    	else{
    		return view('dashboard.alumno');
    	}
    	return view('errors.privilegios');
    }
}
