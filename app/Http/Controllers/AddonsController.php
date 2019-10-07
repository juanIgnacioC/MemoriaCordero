<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddonsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index2()
    {
    	return view('addons.index2');
    }

    public function gallery()
    {
    	return view('addons.gallery');
    }

    public function calendar()
    {
    	return view('addons.calendar');
    }

    public function invoice()
    {
    	return view('addons.invoice');
    }

    public function chat()
    {
    	return view('addons.chat');
    }
}
