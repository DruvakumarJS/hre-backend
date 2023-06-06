<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SplashScreenController extends Controller
{
    public function index(Request $request){

    	if(isset($request->user_id)){

            $user = User::select('isloggedin')->where('id',$request->user_id)->first();

         if($user->isloggedin == '1'){
           
            return response()->json([
                'status'=> 1,
                'message' => 'true'
            ]);

         }
         else {
           
            return response()->json([
                'status'=> 0,
                'message' => 'false'
            ]);

         }

        }
        
        else {
             return response()->json([
                'status'=> 0,
                'message' => 'UnAuthorized'
            ]);

        }

         

    }
}
