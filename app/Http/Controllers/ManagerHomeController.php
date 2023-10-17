<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\Pcn;
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
        $attendance = Attendance::select('user_id')->where('date','LIKE',date('Y-m-d'))->groupBy('user_id')->get();

         $attendance = sizeof($attendance);
        $tickets = Ticket::where('created_at','LIKE','%'.$date.'%')->count();

        $overallticket  = Ticket::count();
        $overall_closed = Ticket::where('status', 'Resolved')->count();
        $month_ticket  = Ticket::where('created_at','LIKE','%'.date('Y-m').'%')->count();
        $month_closed = Ticket::where('status', 'Resolved')->where('created_at','LIKE','%'.date('Y-m').'%')->count();
         

         $counts_array = array('o_tickets' => $overallticket , 'o_closed' => $overall_closed , 'm_tickets' => $month_ticket , 'm_closed' => $month_closed );

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

        return view('manager_home', compact('indents' , 'todaysIndent' , 'attendance' , 'tickets' , 'ticketArry' , 'result','counts_array' ));
    }
}
