<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportCustomer;
use App\Exports\ExportIndents;
use App\Exports\ExportTicket;
use App\Exports\ExportPettycash;
use App\Exports\ExportPcn;
use App\Exports\ExportAttendance;
use App\Exports\ExportAttendanceReport;
use App\Exports\ExportUsers;
use App\Exports\ExportCategory;
use App\Exports\ExportMaterial;
use App\Exports\ExportPettycashSummary;

use Excel ;
use App\Models\customer;
use App\Models\Employee;
use App\Models\Pcn;
use App\Models\Ticket;
use App\Models\Attendance;
use App\Models\Pettycash;
use App\Models\Category;
use App\Models\Material;
use App\Models\PettycashSummary;



class ExportController extends Controller
{
     public function customer(){
        $file_name = 'customers.csv';
        if(Customer::exists()){
         return Excel::download(new ExportCustomer(), $file_name);
        }
        else {
            return redirect()->back();
        }
     }

     public function indent($id){
     	
        $file_name = 'indent.csv';
         return Excel::download(new ExportIndents($id), $file_name);
     }

     public function ticket($filter){
       // print_r($filter);die();
     	
        $file_name = $filter.'_tickets.csv';

        if($filter=='all'){
         if(Ticket::exists()){
          return Excel::download(new ExportTicket($filter), $file_name);
         }
         else {
            return redirect()->back();
         }

        }

        else if($filter=='Reopend'){
         if(Ticket::where('reopened', '1')->exists()){
          return Excel::download(new ExportTicket($filter), $file_name);
         }
         else {
            return redirect()->back();
         }

        }

        else {
          
         if(Ticket::where('creator' ,$filter)
               ->orWhere('status', $filter)->exists()){
           
          return Excel::download(new ExportTicket($filter), $file_name);
         }
         else {
          
             return redirect()->route('tickets');
         }

        }
        

       

     }

     public function pettycash(){
        
        $file_name = 'Pettycash.csv';
        if(Pettycash::exists()){
         return Excel::download(new ExportPettycash(), $file_name);
        }
        else{
            return redirect()->back();
        }
     }

      public function pcn(){

        if(Pcn::exists()){
             return Excel::download(new ExportPcn() , "PCNs.csv");

        }
        else{
            return redirect()->back();
        }
       
    }

    public function attendance(Request $request){

        $user_id = $request->user_id ;
        $start_date = $request->start_date ;
        $end_date = $request->end_date ;
      
          $file_name = 'attendance.csv';
          if(Attendance::where('user_id',$user_id)
              ->whereBetween('date', [$start_date, $end_date])->exists()){
             return Excel::download(new ExportAttendance($user_id ,$start_date, $end_date ), $file_name);
          }
          else {
             return redirect()->back();
          }
        
    }

    public function month_report(){

        
          $month = date('m_Y');
          $file_name = 'attendance_report_'.$month.'.csv';

          if(Attendance::where('date','LIKE' , '%'.date('Y-m').'%' )->exists()){
            return Excel::download(new ExportAttendanceReport($month), $file_name);
          }
          else{
            return redirect()->back();
          }    

    }

    public function users($role){

        if($role == 'All_users'){
            if(Employee::exists()){
                 return Excel::download(new ExportUsers($role) , $role."s.csv");
            }
            else{
                 return redirect()->back();
            }
        
        }

        else if(Employee::where('role',$role)->exists()){
            if(Employee::exists()){
          return Excel::download(new ExportUsers($role) , $role."s.csv");
        }
        else {
            return redirect()->back();
        }
        }
        else {
            return redirect()->back();
        }

    }

      public function category(){
      
         $file_name = 'category.csv';
         if(Category::exists()){
           return Excel::download(new ExportCategory(), $file_name);
         }
         else {
            return redirect()->back();
         }

    }

    public function material($filter){
       
       $file_name = 'Material.csv';
       if($filter=="all"){
        if(Material::exists()){
            return Excel::download(new ExportMaterial($filter), $file_name);

        }
        else{
            return redirect()->back();
            
        }

       }
       else{
        if(Material::where('category_id',$filter)->exists()){
            return Excel::download(new ExportMaterial($filter), $file_name);

        }
        else{
            return redirect()->back();
            
        }

       }
    }

    public function summary(Request $request){
        $user_id = $request->user_id ;
        $emp = Employee::where('user_id', $user_id)->first();
        $start_date = $request->start_date.' 00:00:00'; 
        $end_date = $request->end_date.' 23:59:59'; 
      
          $file_name = 'PettycashSummary_'.$emp->employee_id.'.csv';

          if(PettycashSummary::where('user_id',$user_id)->whereBetween('transaction_date', [$start_date , $end_date])->exists()){

            print_r(PettycashSummary::where('user_id',$user_id)->whereBetween('transaction_date', [$start_date , $end_date])->get());die();

             return Excel::download(new ExportPettycashSummary($user_id ,$start_date, $end_date ), $file_name);
          }
          else {
             return redirect()->back();
          }
      
    }
}
