<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportCustomer;
use App\Exports\ExportIndents;
use App\Exports\ExportTicket;
use App\Exports\ExportPettycash;
use Excel ;


class ExportController extends Controller
{
     public function customer(){
        $file_name = 'customers.csv';
         return Excel::download(new ExportCustomer(), $file_name);
     }

     public function indent($id){
     	
        $file_name = 'indent.csv';
         return Excel::download(new ExportIndents($id), $file_name);
     }

     public function ticket($filter){
     	
        $file_name = $filter.'_tickets.csv';
         return Excel::download(new ExportTicket($filter), $file_name);
     }

     public function pettycash(){
        
        $file_name = 'Pettycash.csv';
         return Excel::download(new ExportPettycash(), $file_name);
     }
}
