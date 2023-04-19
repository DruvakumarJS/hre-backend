<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function validate_login(Request $request){
       

        $validate_user = Employee::where('employee_id',$request->employee_id)
                                 ->first();

       // print_r($validate_user);die();

        if(!empty($validate_user)){
        	$passed = Hash::check($request->password , $validate_user->password);  

       
        if($passed==1 ){

        	return response()->json([ 
        		'status' => 'true' ,
        		'message' => 'login successfull',
        		'data' => $validate_user
        	]);
        } 
        else {
        	return response()->json([
        		'status' => 'false' ,
        		'message' => 'login failed',
        		'data' => ""
        	]);
        }                

        }
        else{
        	return response()->json([
        		'status' => 'false' ,
        		'message' => 'login failed',
        		'data' => ""
        	]);
        }
       

        



    }
}
