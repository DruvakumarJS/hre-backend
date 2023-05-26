<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\Pcn;
use App\Models\Attendance;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
         $tickets = Ticket::where('created_at','LIKE','%'.$date.'%')->count();
         $attendance = Attendance::where('created_at','LIKE','%'.$date.'%')->count();
         
         $Pcn = Pcn::where('status','!=','Completed')->get();
         $result=array();

         foreach ($Pcn as $key => $value) {
            
             $Indents = Intend::where('pcn',$value->pcn)->count();

             if($Indents > 0){
                 $result[$value->client_name][$value->pcn][] = $Indents; 
             }

         }
         // echo '<pre>';
         // print_r($result);
         // exit;

         $chart_pcn = Pcn::select('client_name')->groupby('client_name')->get();

        return view('home', compact('todaysIndent' , 'tickets' ,'attendance' , 'result'));
    }

     public function destroy(){
         auth()->logout();
         return redirect()->route('login');
    }

    function send_email(){
      //  print_r("here");die();
        Mail::to('druva@netiapps.com')->send(new TestEmail());

    }

    function generatePDF(){
         $data = [
            'title' => 'Welcome to HRE',
            'date' => date('m/d/Y')
        ];

         $filename = 'hre.pdf';
          
        $pdf = PDF::loadView('pdf.mypdf', $data);
      // $dfile =  $pdf->download($filename);
        $pdf->save(public_path('test_pdf.pdf'));
       // echo '<pre>';
       // print_r($dfile);
       //$pdf->save(public_path());
        // return $pdf->download($filename);



        // Mail::to('druva@netiapps.com')->send(new TestEmail());

    }
}
