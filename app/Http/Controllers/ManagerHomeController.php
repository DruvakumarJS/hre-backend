<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\Attendance;

class ManagerHomeController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $date = date('Y-m-d');
        $indents = Intend::orderby('id','DESC')->paginate(10);
        $todaysIndent = Intend::where('created_at','LIKE','%'.$date.'%')->count();
        $attendance = Attendance::where('date','LIKE','%'.$date.'%')->count();
        $tickets = Ticket::count();

        return view('manager_home', compact('indents' , 'todaysIndent' , 'attendance' , 'tickets'));
    }
}
