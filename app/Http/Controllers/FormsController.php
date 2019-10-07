<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function common()
    {
    	return view('forms.common');
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
