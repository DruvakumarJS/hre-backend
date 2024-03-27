<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User ;
use App\Models\Vault;
use App\Models\Employee ;

class AppdataController extends Controller
{
    public function index(Request $request){

    	if(isset($request->user_id)){
            $data=array();
            $user = User::select('isloggedin')->where('id',$request->user_id)->first();
         
         if(User::where('id',$request->user_id)->exists()){

         	if($user->isloggedin == '1'){
             if(isset($request->app_version))  {
                 $update = Employee::where('user_id', $request->user_id)->update(['appversion' => $request->app_version]);
             }
           
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
       $directories = array();
        if(isset($request->user_id)){

            $docs = Vault::where('sub_folders' , '0')->where('filename','!=','')->get();
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
        if(isset($request->user_id) && isset($request->f1)){
            $f1 = $request->f1 ;
           
            $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','2')->where('folder','LIKE','vault/'.$f1.'/%')->get();
            $folderarray = array();
            $data = Vault::where('folder','LIKE','vault/'.$f1)->where('filename','!=','')->get();

            
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
        $folderarray=array();
       if(isset($request->user_id) && isset($request->f1) && isset($request->f2)){
        $foldername = $request->f1 ;
        $sub_folder_name = $request->f2 ;

         $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','3')->where('folder','LIKE','vault/'.$foldername.'/'.$sub_folder_name.'/%')->get();
            $folderarray = array();
            $data = Vault::where('folder','LIKE','vault/'.$foldername.'/'.$sub_folder_name)->where('filename','!=','')->get();


            
            foreach ($folders as $key => $value) {
                $directory = $value->folder;
               // $folder_name = substr($directory, 6);
                $folder_name = explode('/' , $directory);
                $folderarray[] = $folder_name[3] ;
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

    public function level3(Request $request){
        $vault=array();
        $folderarray=array();

       if(isset($request->user_id) && isset($request->f1) && isset($request->f2) && isset($request->f3)){
        $f1 = $request->f1 ;
        $f2 = $request->f2 ;
        $f3 = $request->f3 ;

         $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','4')->where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/%')->get();
            $folderarray = array();
            $data = Vault::where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3)->where('filename','!=','')->get();


            foreach ($folders as $key => $value) {
                $directory = $value->folder;    
               // $folder_name = substr($directory, 6);
                $folder_name = explode('/' , $directory);
                $folderarray[] = $folder_name[4] ;
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

    public function level4(Request $request){
        $vault=array();
        $folderarray=array();

       if(isset($request->user_id) && isset($request->f1) && isset($request->f2) && isset($request->f3) && isset($request->f4)){
        $f1 = $request->f1 ;
        $f2 = $request->f2 ;
        $f3 = $request->f3 ;
        $f4 = $request->f4 ;

         $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','4')->where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/'.$f4.'/%')->get();
            $folderarray = array();
            $data = Vault::where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/'.$f4)->where('filename','!=','')->get();


            foreach ($folders as $key => $value) {
                $directory = $value->folder;    
               // $folder_name = substr($directory, 6);
                $folder_name = explode('/' , $directory);
                $folderarray[] = $folder_name[5] ;
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

    public function level5(Request $request){
        $vault=array();
        $folderarray=array();

       if(isset($request->user_id) && isset($request->f1) && isset($request->f2) && isset($request->f3) && isset($request->f4) && isset($request->f5)){
        $f1 = $request->f1 ;
        $f2 = $request->f2 ;
        $f3 = $request->f3 ;
        $f4 = $request->f4 ;
        $f5 = $request->f5 ;

         $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','4')->where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/'.$f4.'/'.$f5.'/%')->get();
            $folderarray = array();
            $data = Vault::where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/'.$f4.'/'.$f5)->where('filename','!=','')->get();


            foreach ($folders as $key => $value) {
                $directory = $value->folder;    
               // $folder_name = substr($directory, 6);
                $folder_name = explode('/' , $directory);
                $folderarray[] = $folder_name[5] ;
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
}
