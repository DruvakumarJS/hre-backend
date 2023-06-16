<?php

namespace App\Exports;

use App\Models\Pettycash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportPettycash implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $att= DB::table('pettycashes')
        ->select('pettycashes.created_at',
        	     'users.name',
        	     'pettycashes.total',
        	     'pettycashes.comments',
        	     'pettycashes.spend',
        	     'pettycashes.remaining',
        	     'pettycashes.mode',
        	     'pettycashes.reference_number'
         )    
         ->join('users', 'pettycashes.user_id', '=', 'users.id')
        ->get();

        return $att ;

    }

    public function headings(): array
     {       
       return [
         'Date','Employee Name','Alloted Amount' , 'Purpose' , 'Utilised Amount' , 'Balance Amount' , 'Mode of Payment' , 'Reference'
       ];
     }
}
