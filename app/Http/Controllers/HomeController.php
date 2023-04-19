<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\Pcn;
use App\Models\Attendance;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
         $todaysIndent = Intend::where('created_at','LIKE','%'.$date.'%')->count();
         $tickets = Ticket::count();
         $attendance = Attendance::where('created_at','LIKE','%'.$date.'%')->count();
         $Pcn = Pcn::get();

        return view('home', compact('todaysIndent' , 'tickets' ,'attendance' , 'Pcn'));
    }

     public function destroy(){
         auth()->logout();
         return redirect()->route('login');
    }
}
