<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Roles;
use App\Models\User;
use App\Mail\AttendanceMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ExportAttendance;
use App\Exports\ExportAttendanceReport;
use DB;
use Auth;
use Excel;
use Mail;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $attendance= Attendance::where('date', 'LIKE','%'.date('Y-m-d').'%')->paginate(50);
       return view('attendance/Attendancelist',compact('attendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $msg = 'Nill';
         if(isset($request->action) && $request->action == 'login')
            {
               
                if(Attendance::where('user_id' , Auth::user()->id)->where('date' , date('Y-m-d'))->orderby('id' ,'DESC')->exists())
                {
                    $updateUser = User::where('id' , Auth::user()->id)->update([
                            'isloggedin' => '1' 
                        ]);
                    $msg = 'Already Loggedin';
                }
                else
                 {
                      $create = Attendance::create([
                        'date' => date('Y-m-d'),
                        'user_id' => Auth::user()->id ,
                        'login_time' => date('H:i') ,
                        'login_lat' => $request->lattitude ,
                        'login_long' => $request->longitude ,
                        'login_location' => 'Bangalore'
                      ]);

                      if($create){
                        
                        $msg = 'Login successfull';
                        $updateUser = User::where('id' , Auth::user()->id)->update([
                            'isloggedin' => '1' 
                        ]);

     

                      }
                      else {
                      
                       $msg = 'Something went wrong';

                      }

             }

            }
            else if(isset($request->action) && $request->action == 'logout')
            {
               if(Attendance::where('user_id' , Auth::user()->id)->where('date' , date('Y-m-d'))->orderBy('id' ,'DESC')->exists()){

                    $login = Attendance::where('user_id' , Auth::user()->id)->where('date' , date('Y-m-d'))->orderBy('id' ,'DESC')->first();

                    $l_in = $login->date." ".$login->login_time;

                    $l_out = date('Y-m-d')." ".date('H:i');

                    $logintime = strtotime($l_in) ;
                    $logouttime = strtotime($l_out);

                    $total_hour = $logouttime - $logintime ; 
                   /* print_r($l_in);print_r('<br>');
                    print_r($l_out);print_r('<br>');
                    print_r($total_hour / 60);die();*/

                    $LOGOUT = Attendance::where('id',$login->id)->update([
                        'logout_time' =>  date('H:i') ,
                        'logout_lat' => $request->lattitude ,
                        'logout_long' => $request->longitude ,
                        'logout_location' => 'Bangalore',
                        'total_hours' => $total_hour/60
                      ]);   

                if($LOGOUT){
                
                 $msg = 'Logout successfull';
                  $updateUser = User::where('id' , Auth::user()->id)->update([
                            'isloggedin' => '0' 
                        ]);

              }
              else {
                
                 $msg = 'Something went wrong .Retry... ';

              }

                }

                else {
                    
                    $msg = 'Login data not found';

                }

            }
            $data =[
                'status'=> 1,
                'message'=> $msg];

            echo json_encode($data) ;

           // echo json_encode($request->Input());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //print_r($request->Input());die();
         $date = date("Y-m-d", strtotime($request->date));
         $logout_time = date("Y-m-d H:i", strtotime($request->logout_time));
         $only_time = date("H:i", strtotime($request->logout_time));
         // print_r($only_time);die();

        if(isset($request->logout_time) && isset($request->break)){
            $login = Attendance::where('user_id' , $request->id)->where('date' , $date)->orderBy('id','desc')->first();

            $l_in = $login->date." ".$login->login_time;

            $l_out = $logout_time;

            $logintime = strtotime($l_in) ;
            $logouttime = strtotime($l_out);

            $diffrence = $logouttime - $logintime ; 
           /* print_r($l_in);print_r('<br>');
            print_r($l_out);print_r('<br>');
            print_r($total_hour / 60);die();*/

            $d_hour =  $diffrence/60 ;
            $total_hour = intval($d_hour)-intval($request->break*60) ;
            $out_of_work = intval($login->out_of_work) + intval($request->break*60);


            $LOGOUT = Attendance::where('user_id' , $request->id)->where('date' , $date)->orderBy('id','desc')->take(1)->update([
                'logout_time' => $only_time ,
                'logout_lat' => $login->login_lat ,
                'logout_long' => $login->login_long ,
                'logout_location' =>$login->login_location,
                'out_of_work'=> $out_of_work,
                'total_hours' => $total_hour
              ]); 

              $body = "Logout timing on date ".$login->date. " is set to ".$request->logout_time." and total working hours is reduced by ".$request->break.'Hour';  

        }
        else if(isset($request->logout_time)){
             $login = Attendance::where('user_id' , $request->id)->where('date' , $date)->orderBy('id','desc')->first();

            $l_in = $login->date." ".$login->login_time;

            $l_out = $logout_time;

            $logintime = strtotime($l_in) ;
            $logouttime = strtotime($l_out);

            $total_hour = $logouttime - $logintime ; 
          
            $LOGOUT = Attendance::where('user_id' , $request->id)->where('date' , $date)->orderBy('id','desc')
             ->take(1)->update([
                'logout_time' =>  $only_time ,
                'logout_lat' => $login->login_lat ,
                'logout_long' => $login->login_long ,
                'logout_location' =>$login->login_location,
                'total_hours' => $total_hour/60
              ]); 

            $body = "Logout timing on date ".$login->date. " is set to ".$request->logout_time;

        }
        else if(isset($request->break)){
             $login = Attendance::where('user_id' , $request->id)->where('date' , $date)->orderBy('id','desc')->first();

             $diffrence = intval($login->total_hours) - intval($request->break*60) ; 
             $out_of_work = intval($login->out_of_work) + intval($request->break*60);

              $LOGOUT = Attendance::where('user_id' , $request->id)->where('date' , $date)->orderBy('id','desc')->take(1)->update([
                'out_of_work'=> $out_of_work,
                'total_hours' => $diffrence
              ]);

            $body = "total working hours on date ".$login->date." is reduced by ".$request->break;

        }

         $empl = Employee::where('user_id',$request->id)->first(); 

         $subject = "Attendance Modified : " .$empl->employee_id;
         $editor = Employee::where('user_id',Auth::user()->id)->first(); 

         $attedance=['name' => $empl->name,
                     'employee_id' => $empl->employee_id ,
                     'editor_name' => $editor->name,
                     'editor_id' => $editor->employee_id,
                     'body' => $body];

         $emailarray = User::select('email')->where('role_id','1')->orWhere('id',$request->id)->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

         //Mail::to($emailid)->send(new AttendanceMail($subject,$attedance));

               try {
                     Mail::to($emailid)->send(new AttendanceMail($subject,$attedance));
                    } catch (\Exception $e) {
                        return $e->getMessage();
                       
                    } 
                    finally {
                     
                     return redirect()->back();
                    }           

        
        
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function employeedetails()
    {
        $employees = Employee::get();
        $data = array();
        $search = '';

        foreach ($employees as $key => $value) {

        $days_present = Attendance::select('date')->where('user_id',$value->user_id)->where('date','LIKE','%'.date('Y-m').'%')->groupBy('date')->get();
         $workinghours = Attendance::where('user_id',$value->user_id)->where('date','LIKE','%'.date('Y-m').'%')->get();
        $role = Roles::where('name',$value->role)->first();
           
            $result = [
                'employee_id' => $value->employee_id,
                'user_id' => $value->user_id,
                'name' => $value->name ,
                'role' => $role->alias ,
                'days_present' => $days_present->count(),
                'working_hours' => $workinghours->sum('total_hours'),
                'mobile' => $value->mobile ];

            array_push($data,$result) ;  

        }

       // print_r($data);die();

        return view('attendance/employee-details', compact('data', 'search') ) ;
    }

    public function employeehistory($id)
    {

           /*$data = array();
          $now = strtotime('2023-08-01');
          $last = strtotime('2023-08-01');
         // $data= array();

         

          while($now <= $last ) {
           // $arr[] = date('Y-m-d', $now);  

            if(Attendance::where('user_id','2')->where('date',date('Y-m-d', $now))->exists()){
                 
                $attendance = Attendance::where('user_id','2')->where('date',date('Y-m-d', $now))->first();

                $attendance_in = Attendance::where('user_id','2')->where('date',date('Y-m-d', $now))->first();
                $attendance_out = Attendance::where('user_id','2')->where('date',date('Y-m-d', $now))->orderBy('id', 'DESC')->first();

                $total_hr = Attendance::where('user_id','2')->where('date',date('Y-m-d', $now))->sum('total_hours');
              

                $login_time = $login ;
                $logout_time = $logout;
                $total_hours = $total_hr;
                $out_of_work = '0';

                if($logout_time == ''){
                    $logout_time = '---';
                }

                if($total_hours != '0'){
                    
                    if($total_hours%60 > '0'){
                         $total_hours = floor($total_hours/60) ."Hr : " . $total_hours%60 ."Min";
                    }
                    else {
                        $total_hours = $total_hours/60 ."Hr";
                    }
                         

                }
                else {
                    $total_hours = '0 Min'; 
                }


                 if($out_of_work != '0'){
                    
                    if($out_of_work%60 > '0'){
                         $out_of_work = floor($out_of_work/60) ."Hr : " . $out_of_work%60 ."Min";
                    }
                    else {
                        $out_of_work = $out_of_work/60 ."Hr";
                    }
                }
                else {
                    $out_of_work = '0 Min'; 
                }
 
 
            }
            else {
                $login_time = '---' ;
                $logout_time = '---';
                $total_hours = '---';
                $out_of_work = '---';

            }
            $res = [
                'date' => date('d-m-Y', $now),
                'login_time' => $login_time,
                'logout_time' => $logout_time,
                'total_hours' => $total_hours,
                //'out_of_work' => $out_of_work,

            ];

            array_push($data, $res);

           $now = strtotime('+1 day', $now);
          }*/

 
        $employee = Employee::where('user_id',$id)->first();
        $attendance = Attendance::where('user_id',$id)->where('date','LIKE','%'.date('Y-m').'%')->get();
        $total_hour = $attendance->sum('total_hours');
       
        return view('attendance/employee-history' , compact('attendance' , 'employee' , 'total_hour'));
    }

    function fetch_data(Request $request)
    {


     if($request->ajax())
     {
      if($request->from_date != '' && $request->to_date != '')
      {

          $data = array();
          $now = strtotime($request->from_date);
          $last = strtotime($request->to_date);
         // $data= array();
         

          while($now <= $last ) {
           // $arr[] = date('Y-m-d', $now);  

            if(Attendance::where('user_id',$request->user_id)->where('date',date('Y-m-d', $now))->exists()){
                $attendance = Attendance::where('user_id',$request->user_id)->where('date',date('Y-m-d', $now))->first();

                $attendance_in = Attendance::where('user_id',$request->user_id)->where('date',date('Y-m-d', $now))->first();
                $attendance_out = Attendance::where('user_id',$request->user_id)->where('date',date('Y-m-d', $now))->orderBy('id', 'DESC')->first();

                $total_hr = Attendance::where('user_id',$request->user_id)->where('date',date('Y-m-d', $now))->sum('total_hours');
                $out_of_hr = Attendance::where('user_id',$request->user_id)->where('date',date('Y-m-d', $now))->sum('out_of_work');
              

                $login = $attendance_in->login_time;
                $logout = $attendance_out->logout_time ;

                $login_time = $login ;
                $logout_time = $logout;
                $total_hours = $total_hr;
                $out_of_work = $out_of_hr;

                if($logout_time == ''){
                    $logout_time = '---';
                }

                 if($out_of_work != '0'){
                    
                    if($out_of_work%60 > '0'){
                         $out_of_work = floor($out_of_work/60) ."Hr : " . $out_of_work%60 ."Min";
                    }
                    else {
                        $out_of_work = $out_of_work/60 ."Hr";
                    }
                }
                else {
                    $out_of_work = '0 Min'; 
                }
 
 
            }
            else {
                $login_time = '---' ;
                $logout_time = '---';
                $total_hours = '---';
                $out_of_work = '---';

            }
            $res = [
                'date' => date('d-m-Y', $now),
                'login_time' => $login_time,
                'logout_time' => $logout_time,
                'total_hours' => $total_hours,
                'out_of_work' => $out_of_work,

            ];

            array_push($data, $res);

           $now = strtotime('+1 day', $now);
          }
       
      }
      else
      {
       $data = 'mnm';
      }
     // echo json_encode($data);
      echo json_encode($data);
     }



    }

     public function export(Request $request){

       // print_r($request->Input());die();

        $user_id = $request->user_id ;
        $start_date = $request->start_date ;
        $end_date = $request->end_date ;
      
          $file_name = 'attendance.csv';
         return Excel::download(new ExportAttendance($user_id ,$start_date, $end_date ), $file_name);

    }

    public function month_report(){
        
          $month = date('m_Y');
          $file_name = 'attendance_report_'.$month.'.csv';

         return Excel::download(new ExportAttendanceReport($month), $file_name);

/*
          $att= DB::table('attendances')
        ->select(
            'attendances.date',
            'attendances.login_time',
            'attendances.logout_time',
            'employees.employee_id',
            'employees.name'
            ) 
        ->join('employees', 'attendances.user_id', '=', 'employees.user_id')
        ->where('date','LIKE' , '%'.date('Y-m').'%' )
        ->get();

        print_r(json_encode($att));die();*/

    }

      public function search(Request $request){

        $employees = Employee::where('name','LIKE','%'.$request->search.'%')->orWhere('employee_id','LIKE','%'.$request->search.'%')->get();
        $data = array();
        $search = $request->search;

        foreach ($employees as $key => $value) {

        $days_present = Attendance::where('user_id',$value->user_id)->where('date','LIKE','%'.date('Y-m').'%')->get();
        $role = Roles::where('name',$value->role)->first();
           
            $result = [
                'employee_id' => $value->employee_id,
                'user_id' => $value->user_id,
                'name' => $value->name ,
                'role' => $role->alias ,
                'days_present' => $days_present->count(),
                'working_hours' => $days_present->sum('total_hours'),
                'mobile' => $value->mobile ];

            array_push($data,$result) ;  

        }

       // print_r($data);die();

        return view('attendance/employee-details', compact('data','search') ) ;
       
    }

    public function search_attendance(Request $request){
        
        $search=$request->search ;


         $attendance= Attendance::whereHas('employee',function($query)use ($search){
            $query->where('name','LIKE','%'.$search.'%')->orWhere('employee_id','LIKE','%'.$search.'%');
         })
         ->where('date', 'LIKE','%'.date('Y-m-d').'%')
         ->paginate(50);

        // print_r(json_encode($attendance)); die();
       return view('attendance/Attendancelist',compact('attendance'));
    }

}


