<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Ticket;
use App\Models\Pcn;
use App\Models\Pettycash;
use App\Models\Attendance;

class FinanceHomeController extends Controller
{
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
        }

        $total_given = json_encode($pc['y'], true);
        $total_used = json_encode($pc['z'], true);
        $date = json_encode($pc['x'], true);

       // print_r( $total_given); die();
           
        


         $chart_pcn = Pcn::select('client_name')->groupby('client_name')->get();

        return view('finance_home', compact('todaysIndent' , 'tickets' ,'attendance' , 'result' , 'tickets_xValue' , 'tickets_yValue', 'tickets_closed_yValue' , 'total_given' , 'total_used' , 'date'));
    }
}