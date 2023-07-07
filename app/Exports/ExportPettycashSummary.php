<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use App\Models\PettycashSummary;

class ExportPettycashSummary implements FromCollection
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
    	 $start = '%'.$this->start_date.'%';
    	 $end = '%'.$this->end_date.'%';
    	
    	
        $summary  = PettycashSummary::where('user_id',$this->user_id)
                    ->whereBetween('created_at', [$start , $end])->get();
        print_r($summary); die();
        return $summary;            

        
    }

    public function headings(): array
     {       
       return [
         'Date','Description' , 'Amount' , 'Type','Balance'
       ];
     }
}
