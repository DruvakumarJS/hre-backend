<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function attendance(Request $request){

    	if(isset($request->user_id)){

    		if(isset($request->action) && $request->action == 'login')
    		{

              
    			if(Attendance::where('user_id' , $request->user_id)->where('date' , date('Y-m-d'))->orderby('id' ,'DESC')->exists())
    			{
    				return response()->json([
					    			'status'=> 1,
					    			'message' => 'Already loggedIn'
					    		]);
    			}
    			else
    			 {
		              $create = Attendance::create([
		              	'date' => date('Y-m-d'),
		              	'user_id' => $request->user_id ,
		              	'login_time' => $request->time ,
		              	'login_lat' => $request->lattitude ,
		              	'login_long' => $request->longitude ,
                        'login_location' => $request->address
		              ]);

		              if($create){
		              	return response()->json([
					    			'status'=> 1,
					    			'message' => 'Login Successfull'
					    		]);

		              }
		              else {
		              	return response()->json([
					    			'status'=> 0,
					    			'message' => 'Something went wrong .Retry... '
					    		]);

		              }

             }

    		}

    		else if(isset($request->action) && $request->action == 'logout')
    		{
    			

    			if(Attendance::where('user_id' , $request->user_id)->where('date' , date('Y-m-d'))->orderBy('id' ,'DESC')->exists()){

    				$login = Attendance::where('user_id' , $request->user_id)->where('date' , date('Y-m-d'))->orderBy('id' ,'DESC')->first();

    				$l_in = $login->date." ".$login->login_time;

    				$l_out = date('Y-m-d')." ".$request->time;

    				$logintime = strtotime($l_in) ;
    				$logouttime = strtotime($l_out);

    				$total_hour = $logouttime - $logintime ; 
                   /* print_r($l_in);print_r('<br>');
                    print_r($l_out);print_r('<br>');
    				print_r($total_hour / 60);die();*/

    				$LOGOUT = Attendance::where('id',$login->id)->update([
		              	'logout_time' => $request->time ,
		              	'logout_lat' => $request->lattitude ,
		              	'logout_long' => $request->longitude ,
                        'logout_location' => $request->address,
		              	'total_hours' => $total_hour/60
		              ]);	

    			if($LOGOUT){
              	return response()->json([
			    			'status'=> 1,
			    			'message' => 'Logout Successfull'
			    		]);

              }
              else {
              	return response()->json([
			    			'status'=> 0,
			    			'message' => 'Something went wrong .Retry... '
			    		]);

              }

    			}

    			else {
    				return response()->json([
			    			'status'=> 0,
			    			'message' => 'Login data not found'
			    		]);

    			}

    			
    		}

    		else {

    			return response()->json([
			    			'status'=> 0,
			    			'message' => 'Insufficient Inputs'
			    		]);

    		}

    		
    	}
    	else{
    		return response()->json([
    			'status'=> 0,
    			'message' => 'UnAuthorized'
    		]);
    	}

    }

    public function myattendance(Request $request){

        if(isset($request->user_id)){

            if(isset($request->start_date) && isset(($request->end_date))){
            $data= array();

            /*$startDate = $request->start_date;
            $endDate = $request->end_date;

            $attendance = Attendance::where('user_id',$request->user_id)->whereBetween('date',[$startDate,$endDate])->get();
            $total_hour = $attendance->sum('total_hours');

            foreach ($attendance as $key => $value) {
                $res = [
                'date' => $value->date,
                'login'=> $value->login_time ,
                'login_location' => $value->login_location,
                'logout' => $value->logout_time,
                'logout_location' => $value->logout_location,
                'working_minutes' => $value->total_hours];

                array_push($data, $res);
            }*/
             $attendance =
             Attendance::where('user_id',$request->user_id)->whereBetween('date',[$request->start_date,$request->end_date])->get();
            $total_hour = $attendance->sum('total_hours');

          $data = array();
          $now = strtotime($request->start_date);
          $last = strtotime($request->end_date);
        
          while($now <= $last ) {
           
            if(Attendance::where('user_id',$request->user_id)->where('date',date('Y-m-d', $now))->exists()){
                $attendance = Attendance::where('user_id',$request->user_id)->where('date',date('Y-m-d', $now))->first();

                $login_time = $attendance->login_time ;
                $logout_time = $attendance->logout_time;
                $total_hours = $attendance->total_hours;
                $login_location = $attendance->login_location;
                $logout_location = $attendance->logout_location;

                if($logout_time == ''){
                    $logout_time = '---';
                }

               /* if($total_hours != '0'){
                    
                    if($total_hours%60 > '0'){
                         $total_hours = $total_hours/60 ."Hr : " . $total_hours%60 ."Min";
                    }
                    else {
                        $total_hours = $total_hours/60 ."Hr";
                    }
                }
                else {
                    $total_hours = '0 Min'; 
                }*/
 
            }
            else {
                $login_time = '---' ;
                $logout_time = '---';
                $total_hours = '---';

            }
            $res = [
                'date' => date('Y-m-d', $now),
                'login'=> $login_time ,
                'login_location' => '',
                'logout' => $logout_time,
                'logout_location' => '',
                'working_minutes' => $total_hours

            ];

            array_push($data, $res);

           $now = strtotime('+1 day', $now);
          }
           
            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'total_minute' => $total_hour,
                'data' => $data]);

            }

           /* else if (isset($request->date)) {

            $attendance = Attendance::where('user_id',$request->user_id)->where('date','LIKE', '%'.$request->date.'%')->get();
            $total_hour = $attendance->sum('total_hours');
           
            $data= array();

            foreach ($attendance as $key => $value) {
                $res = [
                'date' => $value->date,
                'login'=> $value->login_time ,
                'login_location' => $value->login_location,
                'logout' => $value->logout_time,
                'logout_location' => $value->logout_location,
                'working_minutes' => $value->total_hours];

                array_push($data, $res);
            }
           

            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'total_minute' => $total_hour,
                'data' => $data]);

        }*/
        else {
             return response()->json([
                'status'=> 0,
                'message' => 'Insufficient Inputs',
                'total_minute' => '0',
                'data' => ''
            ]);
        }

       }

        else {
            return response()->json([
                'status'=> 0,
                'message' => 'UnAuthorized',
                'total_minute' => '0',
                'data' => ''
            ]);
        }


    }
}
