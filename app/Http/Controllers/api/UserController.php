<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   
    public function validate_login(Request $request){

         $credentials = $request->only('email', 'password');
          $userdata= array();
        if (Auth::attempt($credentials)) {

            $user = User::where('email' , $request->email)->first();

            $isloggedin = $user->isloggedin;

            if($isloggedin == '0'){
               $update = User::where('email' , $request->email)->update(['isloggedin'=>'1' , 'device_id'=> $request->device_id]);
               if($update){
                 $search = Employee::where('email',$request->email)
                        ->first();
          
                if(!empty($search)){
                    $userdata = [
                        'user_id' => $search->user_id,
                        'employee_id' => $search->employee_id,
                        'username' => $search->name,
                        'role' => $search->role,
                        'role_name' => $search->user->roles->alias
                         ];

                     return response()->json([
                        'status' => "TRUE",
                        'message' => 'success',
                        'data' => array($userdata)]
                        );
                }

                else {
                     return response()->json([
                            'status'=> "FALSE",
                            'message' => 'Invalid credentials',
                            'data' => $userdata
                            
                    ]);

                }    
               }
            }
            
            else if($user->device_id == $request->device_id)
            {
                $search = Employee::where('email',$request->email)
                        ->first();
          
                if(!empty($search)){
                    $userdata = [
                        'user_id' => $search->user_id,
                        'employee_id' => $search->employee_id,
                        'username' => $search->name,
                        'role' => $search->role,
                        'role_name' => $search->user->roles->alias
                         ];

                     return response()->json([
                        'status' => "TRUE",
                        'message' => 'success',
                        'data' => array($userdata)]
                        );
                }

                else {
                     return response()->json([
                            'status'=> "FALSE",
                            'message' => 'Invalid credentials',
                            'data' => $userdata
                            
                    ]);

                }    
            }
            else{
                 return response()->json([
                            'status'=> "FALSE",
                            'message' => 'Please contact your Administrator',
                            'data' => $userdata
                            
                    ]);

            }

             
           
        }

        else {
            return response()->json([
            'status' => "FALSE",
            'message' => 'Invalid credentials',
            'data' => $userdata
            
        ]);

        }
      
    }

    function employees(Request $request){

        if(isset($request->user_id)){
           
            $users = User::where('role_id', '!=' , '1')->get();

            foreach ($users as $key => $value) {
                $roles = Roles::select('alias')->where('id', $value->role_id)->first();
                $data[] = [
                    'recipient' => $value->id,
                    'name' => $value->name , 
                    'role' => $roles->alias 
                ];
            }
            return response()->json([
                    'status' => 1,
                    'message' => 'Success',
                    'data' => $data
                    
                ]);
        }
        else {
             return response()->json([
                    'status' => 0,
                    'message' => 'UnAuthorized',
                    'data' => ''
                    
                ]);


        }
    }


}
