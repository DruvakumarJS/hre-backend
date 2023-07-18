<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use App\Models\PettycashSummary;

class ExportPettycashSummary implements FromCollection,WithHeadings
{
    private $user_id;
	private $start_date;
	private $end_date;


	public function __construct($user_id ,$start_date , $end_date ) 
    {
        $this->user_id = $user_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        
    } 

    public function collection()
    {
    	 $start = date($this->start_date);
    	 $end = date($this->end_date);
    	
    	/*print_r($start);
        print_r($end); die();*/
       /* $summary  = PettycashSummary::select('created_at' )->where('user_id',$this->user_id)
                    ->whereBetween('created_at', [$start , $end])->get();*/


       
        $summary = DB::table('pettycash_summaries')
                 ->select(DB::raw("DATE_FORMAT(pettycash_summaries.transaction_date, '%d-%m-%Y') as formatted_date"),
                           'mode',
                           'reference_number',
                           'comment',
                           'amount',
                           'type',
                           'balance',
                           DB::raw("DATE_FORMAT(pettycash_summaries.created_at, '%d-%m-%Y %H:%i') as created_date")
                           )
                 ->where('user_id', $this->user_id)
                 ->whereBetween('transaction_date', [$start , $end])
                 ->get();

                // print_r(json_encode($summary)) ; die();

        return $summary;            

        
    }

    public function headings(): array
     {       
       return [
         'Date','Mode','Reference Number','Description' , 'Amount' , 'Type','Balance', 'Entry Date'
       ];
     }
}
