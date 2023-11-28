<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\Pcn;
use App\Models\User;
use App\Models\Pettycash;
use App\Models\PettyCashDetail;
use App\Models\Attendance;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use PDF;
use DB;
use Auth;
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
        if(Auth::user()->role_id != 13 AND Auth::user()->role_id != 14){
         $date = date('Y-m-d');
         $todaysIndent = Intend::where('created_at','LIKE','%'.$date.'%')->count();
         $tickets = Ticket::where('created_at','LIKE','%'.$date.'%')->count();
         $attendance = Attendance::select('user_id')->where('date','LIKE',date('Y-m-d'))->groupBy('user_id')->get();

         $attendance = sizeof($attendance);

         $overallticket  = Ticket::count();
         $overall_closed = Ticket::where('status', 'Resolved')->count();
         $overall_alloted = Pettycash::get()->sum('total');
         $overall_used = PettyCashDetail::where('isapproved', '1')->get()->sum('spent_amount');


         $month_ticket  = Ticket::where('created_at','LIKE','%'.date('Y-m').'%')->count();
         $month_closed = Ticket::where('status', 'Resolved')->where('created_at','LIKE','%'.date('Y-m').'%')->count();
         $month_alloted = Pettycash::where('issued_on','LIKE','%'.date('Y-m').'%')->get()->sum('total');
         $month_used = PettyCashDetail::where('bill_date','LIKE','%'.date('Y-m').'%')->where('isapproved', '1')->get()->sum('spent_amount');

         $counts_array = array('o_tickets' => $overallticket , 'o_closed' => $overall_closed , 'o_alloted' => $overall_alloted , 'o_used'=>$overall_used ,  'm_tickets' => $month_ticket , 'm_closed' => $month_closed , 'm_alloted' => $month_alloted , 'm_used'=>$month_used );
         
         $Pcn = Pcn::where('status','!=','Completed')->get();
         $result=array();

             foreach ($Pcn as $key => $value) {
                
                 $Indents = Intend::where('pcn',$value->pcn)->count();

                 if($Indents > 0){
                     $result[$value->client_name][$value->pcn][] = $Indents; 
                 }

             }
           /*Tickets chart*/
            $montharray=array();
            $month = date("t", strtotime('2021-10-18'));
            $alldatethismonth = range(1, $month);
            $count = 0;
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

                if($ticket_count->count() > 0){
                    $count++;
                    
                }
              
                 $tckets_closed_count=Ticket::where('updated_at','LIKE','%'.$today.'%')
                ->where('status', 'Resolved')->get();

                 $tickets_closed['y'][]=$tckets_closed_count->count();

                 if($tckets_closed_count->count() > 0){
                    $count++;
                    
                }
        
            }

            $tickets_xValue = json_encode($results['x'], true);
            $tickets_yValue = json_encode($results['y'], true);
            $tickets_closed_yValue = json_encode($tickets_closed['y'], true);

            $ticketArry = array('tickets_xValue' => $tickets_xValue, 'tickets_yValue'=>$tickets_yValue ,  'tickets_closed_yValue' => $tickets_closed_yValue);

           $montharray=array();
            $month = date("t", strtotime('2021-10-18'));
            $alldatethismonth = range(1, $month);
            $count = 0;
            foreach($alldatethismonth as $date){
               
               if(strlen($date)==1){
                 $today=date("Y-m-").'0'.$date;
               }
               else
               {
                $today=date("Y-m-").$date;
               }
               
                $amount_issued=DB::table('pettycashes')->where('issued_on',$today)->sum('total');
              
                $results['issued'][]=$amount_issued;
                $results['date'][]=$date;

                
                 $amount_utilised=DB::table('petty_cash_details')->where('bill_date',$today)->where('isapproved', '1')->sum('spent_amount');
                
                 $results['utilised'][]=$amount_utilised;

            }
         
            $date = json_encode($results['date'], true);
            $total_issued = json_encode($results['issued'], true);
            $total_utilised = json_encode($results['utilised'], true);

            $pettycashArry = array('date' => $date, 'total_issued'=>$total_issued ,  'total_utilised' => $total_utilised);

        return view('dashboard', compact('todaysIndent' , 'tickets' ,'attendance' , 'result' ,'ticketArry', 'date' , 'count' , 'counts_array' , 'pettycashArry'));
    }
    else{
        $date = date('Y-m');
        $indents = Intend::where('user_id', Auth::user()->id)->count();
        $attendance = Attendance::where('user_id', Auth::user()->id)->where('date', 'LIKE','%'.date('Y-m-d').'%')->count();
        $tickets = Ticket::where('creator', Auth::user()->id)->count();
        

        return view('dashboard', compact('indents' , 'attendance','tickets'));
    }

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
