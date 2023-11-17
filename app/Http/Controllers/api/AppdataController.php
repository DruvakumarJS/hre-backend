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

    public function view_vault(Request $request){
       $vault = array();
        if(isset($request->user_id)){

            $docs = Vault::where('sub_folders' , '0')->get();
            $folders = Vault::select('folder')->where('sub_folders' , '1')->groupBy('folder')->get();

            foreach ($folders as $key => $value) {
               $directories[] = substr($value->folder, 6);
            }

            $vault = ['data' => $docs , 'folders' => $directories];

            return response()->json([
                        'status'=> 1,
                        'message' => 'Success',
                        'data' => $vault
                        
                ]);

        }
        else{

            return response()->json([
                            'status'=> 0,
                            'message' => 'UnAuthorized',
                            'data' => $vault
                            
                    ]);
        }

        
    }

    public function sub_directory1(Request $request){
         $vault=array();
        if(isset($request->user_id) && isset($request->foldername)){
            $foldername = $request->foldername ;
           
            $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','2')->where('folder','LIKE','vault/'.$foldername.'/%')->get();
            $folderarray = array();
            $data = Vault::where('folder','LIKE','vault/'.$foldername)->get();

            
            foreach ($folders as $key => $value) {
                $directory = $value->folder;
               // $folder_name = substr($directory, 6);
                $folder_name = explode('/' , $directory);
                $folderarray[] = $folder_name[2] ;
            }

            $vault = ['data' => $data , 'folders' => $folderarray];

            return response()->json([
                        'status'=> 1,
                        'message' => 'Success',
                        'data' => $vault
                        
                ]);
        
        }
        else{
            return response()->json([
                            'status'=> 0,
                            'message' => 'UnAuthorized',
                            'data' => $vault
                            
                    ]);

        }
     
    }

    public function sub_sub_directory(Request $request){
        $vault=array();
       if(isset($request->user_id) && isset($request->foldername) && isset($request->sub_folder_name)){
        $foldername = $request->foldername ;
        $sub_folder_name = $request->sub_folder_name ;
       
        $vault = Vault::where('folder','LIKE','vault/'.$foldername.'/'.$sub_folder_name.'%')->get();

        return response()->json([
                        'status'=> 1,
                        'message' => 'Success',
                        'data' => $vault
                        
                ]);

        }
        else{
            return response()->json([
                            'status'=> 0,
                            'message' => 'UnAuthorized',
                            'data' => $vault
                            
                    ]);

        }

    }
}
