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
use App\Exports\ExportMultipleIndents;
use App\Exports\ExportVendors;

use Excel ;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Pcn;
use App\Models\Ticket;
use App\Models\Attendance;
use App\Models\Pettycash;
use App\Models\Category;
use App\Models\Material;
use App\Models\Intend;
use App\Models\PettycashSummary;
use App\Models\VendorDepartment;

use DB;
use Auth;



class ExportController extends Controller
{
     public function customer(Request $request){
     // print_r("se".$request->search); die();
       $search = $request->search ;
        $file_name = 'customers.csv';
        if(Customer::exists()){
         return Excel::download(new ExportCustomer($search), $file_name);
        }
        else {
            return redirect()->back();
        }
     }

     public function indent($id){
     	
        $file_name = 'indent.csv';
         return Excel::download(new ExportIndents($id), $file_name);
     }

     public function ticket(Request $request ){
      //print_r('search'.$request->filter);die();

      //return redirect()->route('tickets');

      $filter = $request->filter;
      $search = $request->search;

      if($filter == 'Pending')
        {
          $filter = 'Pending/Ongoing';
          $file_name = 'Pending_tickets.csv';
        }
        else{
           $file_name = $filter.'_tickets.csv';
        }

      return Excel::download(new ExportTicket($filter , $search), $file_name);

      /*if(auth::user()->role_id == '1' OR auth::user()->role_id == '2' OR auth::user()->role_id == '5'){
       if($filter == 'Pending')
        {
          $filter = 'Pending/Ongoing';
          $file_name = 'Pending_tickets.csv';
        }
        else{
           $file_name = $filter.'_tickets.csv';
        }
      

        if($filter=='all'){
         if(Ticket::exists()){
          return Excel::download(new ExportTicket($filter , $search), $file_name);
         }
         else {
            return redirect()->back();
         }

        }

        else if($filter=='Reopend'){
         if(Ticket::where('reopened', '1')->exists()){
          return Excel::download(new ExportTicket($filter, $search), $file_name);
         }
         else {
            return redirect()->back();
         }

        }

        else {
          
         if(Ticket::where('creator' ,$filter)
               ->orWhere('status', $filter)->exists()){
           
          return Excel::download(new ExportTicket($filter, $search), $file_name);
         }
         else {
          
             return redirect()->route('tickets');
         }

        }
       }
       else {
       
         $filter = '';
         $file_name = "tickets.csv";

         return Excel::download(new ExportTicket($filter, $search), $file_name);

       }
        
       return redirect()->route('tickets');*/
       

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

      public function pcn( Request $request){

        $search = $request->search ;
        if(Pcn::exists()){
             return Excel::download(new ExportPcn($search) , "PCNs.csv");

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

    public function material(Request $request){
         
      // print_r($request->Input());die();
       if($request->search == ''){
        $filter = 'all';
       }
       else{
         $filter = $request->search ;
       }
      
       if(isset($request->start_date)){
        $start = $request->start_date . ' 00:00:01';
       $end = $request->end_date. ' 23:59:59'; 
       }
       else {
        $start = '';
        $end = ''; 
       }
       

       $file_name = 'Material.csv';
       if($filter=="all"){
        if(Material::whereBetween('created_at', [$start , $end])->exists()){
            return Excel::download(new ExportMaterial($filter ,$start , $end), $file_name);

        }
        else{
            return redirect()->back();
            
        }

       }
       else{
        if(Material::whereBetween('created_at', [$start , $end])->exists()){
            return Excel::download(new ExportMaterial($filter , $start , $end), $file_name);

        }
        else{
            return redirect()->back();
            
        }

       }
    }

    public function summary(Request $request){

        $user_id = $request->user_id ;
        $emp = Employee::where('user_id', $user_id)->first();
        $start_date = $request->start_date; 
        $end_date = $request->end_date; 
      
          $file_name = 'PettycashSummary_'.$emp->employee_id.'.csv';

          if(PettycashSummary::where('user_id',$user_id)->whereBetween('transaction_date', [$start_date , $end_date])->exists()){

             return Excel::download(new ExportPettycashSummary($user_id ,$start_date, $end_date ), $file_name);
          }
          else {
             return redirect()->back();
          }
      
    }

    public function download_multiple_indents(Request $request){

   
      $file_name = 'indents.csv';

      $indents = $request->selctedindent;

      $indentarray= explode (',', $indents);
     
      return Excel::download(new ExportMultipleIndents($indentarray), $file_name);
   
    }

    public function vendors(Request $request){
      $file_name = 'vendors_departments.csv';
      $search = $request->search ;

       return Excel::download(new ExportVendors($search), $file_name);
    }
}
