<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   
    public function validate_login(Request $request){

         $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $search = Employee::where('email',$request->email)
                    ->where('role','supervisor')
                    ->first();
      

            if(!empty($search)){
                $userdata = [
                    'user_id' => $search->user_id,
                    'employee_id' => $search->employee_id,
                    'username' => $search->name,
                    'role' => $search->role
                     ];

                 return response()->json([
                    'status' => 1,
                    'message' => 'success',
                    'data' => $userdata]
                    ,200);
            }

            else {
                 return response()->json([
                        'status '=> 0,
                        'message' => 'Invalid credentials',
                        'data' => ''
                        
                ],200);

            }     
           
        }

        else {
            return response()->json([
            'status' => 0,
            'message' => 'Invalid credentials',
            'data' => ''
            
        ],200);

        }
      
    }


}
