<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\Pcn;
use App\Models\Pettycash;
use App\Models\Attendance;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FinanceHomeController extends Controller
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
        
        // Tickets chart
        $montharray=array();
        $month = date("t", strtotime('2021-10-18'));
        $alldatethismonth = range(1, $month);
        foreach($alldatethismonth as $date){
           
           if(strlen($date)==1){
             $today=date("Y-m-").'0'.$date;
           }
           else
           {
            $today=date("Y-m-").$date;
           }
           
            $ticket_count=Ticket::where('created_at','LIKE','%'.$today.'%')->get();
            $results['y'][]=$ticket_count->count();
            $results['x'][]=$date;

             $tckets_closed_count=Ticket::where('updated_at','LIKE','%'.$today.'%')
            ->where('status', 'Completed')->get();

             $tickets_closed['y'][]=$tckets_closed_count->count();
    
        }

            $tickets_xValue = json_encode($results['x'], true);
            $tickets_yValue = json_encode($results['y'], true);
            $tickets_closed_yValue = json_encode($tickets_closed['y'], true);

        $Pettycash = Pettycash::where('created_at', 'LIKE','%'.date('Y-m').'%')->get();

        foreach ($Pettycash as $key => $value) {
            $pc['y'][] = $value->total;
            $pc['z'][]= $value->spend;
            $pc['x'][] = date("d-m-Y", strtotime($value->created_at)) ;

          
            $total[] = [
                'y' => intval( $value->remaining),
                'x' => intval(date("d", strtotime($value->created_at))) 
                ];

            $used[] = [
                'y' => intval($value->spend),
                'x' => intval(date("d", strtotime($value->created_at))) 
                ]; 

               

        }

        $total_given = json_encode($pc['y'], true);
        $total_used = json_encode($pc['z'], true);
        $date = json_encode($pc['x'], true);



       $pc_given = json_encode($total, true);
        // $pc_given = $total;

        $pc_used = json_encode($used, true);


         $chart_pcn = Pcn::select('client_name')->groupby('client_name')->get();

        return view('finance_home', compact('todaysIndent' , 'tickets' ,'attendance' , 'result' , 'tickets_xValue' , 'tickets_yValue', 'tickets_closed_yValue' , 'total_given' , 'total_used' , 'date' , 'pc_given' , 'pc_used'));
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
