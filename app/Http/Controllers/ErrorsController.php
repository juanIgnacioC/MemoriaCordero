<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function error403()
    {
    	return view('errors.error403');
    }

    public function error404()
    {
    	return view('errors.error404');
    }

    public function error405()
    {
    	return view('errors.error405');
    }

    public function error500()
    {
    	return view('errors.error500');
    }

    public function privilegios()
    {
        return view('errors.privilegios');
    }

}
