<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\Attendance;
use Auth ;

class SupervisorHomeController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
    	$date = date('Y-m');
    	$indents = Intend::where('user_id', Auth::user()->id)->where('created_at', 'LIKE','%'.$date.'%')->count();
    	$attendance = Attendance::where('user_id', Auth::user()->id)->where('date', 'LIKE','%'.$date.'%')->count();
    	$tickets = Ticket::where('creator', Auth::user()->id)->where('created_at', 'LIKE','%'.$date.'%')->count();
    	

    	return view('supervisor_home', compact('indents' , 'attendance','tickets'));
    }
}
