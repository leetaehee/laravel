<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
	{
	    flash('환영합니다.');

		return view('layouts.app');
	}
}
