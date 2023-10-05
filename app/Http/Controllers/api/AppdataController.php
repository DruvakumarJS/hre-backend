<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User ;
use App\Models\Vault;

class AppdataController extends Controller
{
    public function index(Request $request){

    	if(isset($request->user_id)){
            $data=array();
            $user = User::select('isloggedin')->where('id',$request->user_id)->first();
         
         if(User::where('id',$request->user_id)->exists()){
         	 if($user->isloggedin == '1'){
           
           
            $data = ['isloggedin' => 'true',
                     'app_version' => '1.0',
                     'need_update' => 'No'];
           
            return response()->json([
                'status'=> 1,
                'message' => 'success',
                'data' => $data
            ]);

         }
         else {
            $data = ['isloggedin' => 'false',
                     'app_version' => '1.0',
                     'need_update' => 'No'];
           
           return response()->json([
                'status'=> 1,
                'message' => 'success',
                'data' => $data
            ]);

         }

         }
         else {
         	return response()->json([
                'status'=> 0,
                'message' => 'UnAuthorized',
                'data' => $data
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

    public function vault(Request $request){
        $data = array();
        if(isset($request->user_id)){

            $vault = Vault::get();

            foreach ($vault as $key => $value) {
                 $data[] = ['name' => $value->name,
                          'type' => $value->type,
                          'filepath' => url('/').'/vault/',
                          'filename' => $value->filename];
            }
            
            return response()->json([
                            'status'=> 1,
                            'message' => 'Success',
                            'data' => $data
                            
                    ]);
           
          
        }
        else {
             return response()->json([
                            'status'=> 0,
                            'message' => 'UnAuthorized',
                            'data' => $data
                            
                    ]);
        }

    }
}
