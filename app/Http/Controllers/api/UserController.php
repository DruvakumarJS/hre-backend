<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
    	$Users = User::all();

    	return response()->json([
    		'status'=> 1,
    		'data'=> $Users
    	],200);

    }

    public function search(Request $request){

     //   $user = User::where('email',$request->email)->

     $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

        	$search = User::where('email',$request->email)
 
    	            ->first();

                    $userarray=[
                        'password'=>$search->password ,
                        'user_name'=>$s];

           return response()->json([
    		'status'=> 1,
    		'data'=> $userarray
    	],200);
           
        }

        else {
        	return response()->json([
    		'status'=> 0,
    		'message' => 'No user found'
    		
    	],200);

        }
      
    	
    }

    public function validate_login(Request $request){

         $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $search = Employee::where('email',$request->email)
                    ->where('role','supervisor')
                    ->first();
      

            if(!empty($search)){
                 return response()->json([
                    'status'=> 1,
                    'data'=> $search
                             ],200);
            }
            else {
                 return response()->json([
                        'status'=> 0,
                        'message' => 'Invalid credentials'
                        
                ],200);

            }     
           
        }

        else {
            return response()->json([
            'status'=> 0,
            'message' => 'Invalid credentials'
            
        ],200);

        }
      
    }


}
