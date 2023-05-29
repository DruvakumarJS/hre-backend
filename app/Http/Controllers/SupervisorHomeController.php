<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorHomeController extends Controller
{
    public function index(){
    	return view('supervisor_home');
    }
}
