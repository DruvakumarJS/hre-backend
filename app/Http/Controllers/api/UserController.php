<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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

     $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

        	$search = User::where('email',$request->email)
 
    	            ->first();

           return response()->json([
    		'status'=> 1,
    		'data'=> $search
    	],200);
           
        }

        else {
        	return response()->json([
    		'status'=> 0,
    		'message' => 'No user found'
    		
    	],200);

        }
      
    	
    }
}
