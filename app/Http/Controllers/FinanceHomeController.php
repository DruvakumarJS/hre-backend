<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\Pcn;
use App\Models\User;
use App\Models\Pettycash;
use App\Models\Attendance;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use PDF;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class FinanceHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
         $date = date('Y-m-d');
         $todaysIndent = Intend::where('created_at','LIKE','%'.$date.'%')->count();
         $tickets = Ticket::where('created_at','LIKE','%'.$date.'%')->count();
         $attendance = Attendance::select('user_id')->where('date','LIKE',date('Y-m-d'))->groupBy('user_id')->get();

         $attendance = sizeof($attendance);

         $overallticket  = Ticket::count();
         $overall_closed = Ticket::where('status', 'Resolved')->count();
         $overall_alloted = Pettycash::get()->sum('total');
         $overall_used = Pettycash::get()->sum('spend');


         $month_ticket  = Ticket::where('created_at','LIKE','%'.date('Y-m').'%')->count();
         $month_closed = Ticket::where('status', 'Resolved')->where('created_at','LIKE','%'.date('Y-m').'%')->count();
         $month_alloted = Pettycash::where('created_at','LIKE','%'.date('Y-m').'%')->get()->sum('total');
         $month_used = Pettycash::where('created_at','LIKE','%'.date('Y-m').'%')->get()->sum('spend');

         $counts_array = array('o_tickets' => $overallticket , 'o_closed' => $overall_closed , 'o_alloted' => $overall_alloted , 'o_used'=>$overall_used ,  'm_tickets' => $month_ticket , 'm_closed' => $month_closed , 'm_alloted' => $month_alloted , 'm_used'=>$month_used );
           


         
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

           /*tickets end */

           /*PettyCash*/

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
          // print_r($today);
           
            $amount_issued=DB::table('pettycashes')->where('issued_on',$today)->sum('total');
           //  print_r($amount_issued); print_r("  ");
 
           
            $results['issued'][]=$amount_issued;
            $results['date'][]=$date;

            
             $amount_utilised=DB::table('petty_cash_details')->where('bill_date',$today)->where('isapproved', '1')->sum('spent_amount');
              //print_r($amount_utilised);echo"<br>";

             $results['utilised'][]=$amount_utilised;

            
    
        }
         // die();

            $date = json_encode($results['date'], true);
            $total_issued = json_encode($results['issued'], true);
            $total_utilised = json_encode($results['utilised'], true);

            $pettycashArry = array('date' => $date, 'total_issued'=>$total_issued ,  'total_utilised' => $total_utilised);


           /*Pettycash*/

       

        return view('finance_home', compact('todaysIndent' , 'tickets' ,'attendance' , 'result' ,'ticketArry', 'date' , 'count' , 'counts_array' , 'pettycashArry'));
    }
}
