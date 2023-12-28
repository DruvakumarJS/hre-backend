<?php

namespace App\Http\Controllers;

use App\Models\Vault;
use Illuminate\Http\Request;
use File;
use App\Models\FootPrint;
use Auth;
use Storage;

class VaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vault = Vault::all();
        return view('vault/create',compact('vault'));
    }

    public function view_vault()
    {
        $vault = Vault::all();
        $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','1')->where('folder','LIKE','vault/'.'%')->get();
        $folderarray = array();
        $data = Vault::where('folder','vault')->where('filename','!=','')->get();

        
        foreach ($folders as $key => $value) {
            $directory = $value->folder;
            $folder_name = substr($directory, 6);
            $folderarray[] = $folder_name ;
        }

       // print_r($folderarray); die();

        //$vault = Vault::all();
        return view('vault/list',compact('vault' , 'folderarray' , 'data'));
    }

    public function sub_directory1($foldername){
       
        $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','2')->where('folder','LIKE','vault/'.$foldername.'/%')->get();
        $folderarray = array();
        $data = Vault::where('folder','LIKE','vault/'.$foldername)->where('filename','!=','')->get();

        
        foreach ($folders as $key => $value) {
            $directory = $value->folder;
           // $folder_name = substr($directory, 6);
            $folder_name = explode('/' , $directory);
            $folderarray[] = $folder_name[2] ;
        }

       // print_r($folderarray); die();

        //$vault = Vault::all();
        return view('vault/sub_directory',compact('folderarray' , 'data' , 'foldername'));
    }

    public function sub_sub_directory($foldername , $sub_folder_name){
     
        $folderarray = array();
        $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','3')->where('folder','LIKE','vault/'.$foldername.'/'.$sub_folder_name.'/%')->get();
       
        foreach ($folders as $key => $value) {
            $directory = $value->folder;
           // $folder_name = substr($directory, 6);
            $folder_name = explode('/' , $directory);
            $folderarray[] = $folder_name[3] ;
        }

         // print_r($folderarray); die();
       
        $data = Vault::where('folder','LIKE','vault/'.$foldername.'/'.$sub_folder_name)->where('filename','!=','')->get();

        return view('vault/sub_sub_directory',compact('data' , 'folderarray','foldername','sub_folder_name'));

    }

    public function level3($f1 , $f2 ,$f3){

        $folderarray = array();
        $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','4')->where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/%')->get();

        foreach ($folders as $key => $value) {
            $directory = $value->folder;
           // $folder_name = substr($directory, 6);
            $folder_name = explode('/' , $directory);
            $folderarray[] = $folder_name[4] ;
        }
       
        $data = Vault::where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3)->where('filename','!=','')->get();
       //  print_r(json_encode($data)); die();

        return view('vault/level3',compact('data' , 'folderarray','f1','f2','f3'));

    }

    public function level4($f1 , $f2 ,$f3 , $f4){
     // print_r("kk"); die();
        $folderarray = array();
        $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','5')->where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/'.$f4.'/%')->get();

        foreach ($folders as $key => $value) {
            $directory = $value->folder;
           // $folder_name = substr($directory, 6);
            $folder_name = explode('/' , $directory);
            $folderarray[] = $folder_name[5] ;
        }
       
        $data = Vault::where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/'.$f4)->where('filename','!=','')->get();

        return view('vault/level4',compact('data' ,'folderarray', 'f1','f2','f3','f4'));

    }

    public function level5($f1 , $f2 ,$f3 , $f4 , $f5){
        $folderarray = array();
        $folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','6')->where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/'.$f4.'/'.$f5.'/%')->get();

        foreach ($folders as $key => $value) {
            $directory = $value->folder;
           // $folder_name = substr($directory, 6);
            $folder_name = explode('/' , $directory);
            $folderarray[] = $folder_name[6] ;
        }
       
        $data = Vault::where('folder','LIKE','vault/'.$f1.'/'.$f2.'/'.$f3.'/'.$f4.'/'.$f5)->where('filename','!=','')->get();

        return view('vault/level5',compact('data' ,'folderarray', 'f1','f2','f3','f4','f5'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       // print_r($request->Input());


        if($request->hasFile('file')){

        $imagearray= array();
        if($request->directory != ''){
            $folder =  $request->directory ;
        }
        else if($request->folder_name != ''){
            $folder =  $request->folder_name ;
        }
        else{
            $folder = '';
        }


        if($folder != ''){
            $path = 'vault/' . $folder;
            $sub_folders = '1';
            
            if (file_exists(public_path().'/'.$path)) {
              
            } else {
               
                File::makeDirectory(public_path().'/'.$path, $mode = 0777, true, true);
            }
            
        }
        else{
            $path ='vault'; 
            $sub_folders = '0' ;
        }

       // print_r($sub_folders); die();
        if(Vault::where('name', $request->name)->where('sub_folders', $sub_folders)->exists()){
             
             return redirect()->back()->withMessage('Document name already exists. Please use different name');

            }

        if($file = $request->hasFile('file')) {

            foreach($_FILES['file']['name'] as $key=>$val){ 
                
            $fileName = basename($_FILES['file']['name'][$key]); 
            $temp = explode(".", $fileName);

             //print_r($temp[0]); die();
                 
            $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/'.$path.'/'.$fileName ;
           // print_r($destinationPath); die();
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);
            

             $vault = Vault::create([
                'name' => $temp[0],
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $fileName ,
            ]); 

            $footprint = FootPrint::create([
                    'action' => 'New File uploaded - '.$path.'/'.$temp[0]. '.' . end($temp),
                    'user_id' => Auth::user()->id,
                    'module' => 'Vault',
                    'operation' => 'C'
                ]); 
                 
            }
          
          }

        return redirect()->back();
           
        }
        else{
         
          return redirect()->back();
        } 

    }

    public function save_sub_directory_files(Request $request){
       // print_r($request->Input()); die();
        if($request->hasFile('file')){

        $imagearray= array();
        if($request->directory != ''){
            $folder =  $request->directory ;
        }
        else if($request->folder_name != ''){
            $folder =  $request->folder_name ;
        }
        else{
            $folder = '';
        }


        if($folder != ''){
            $path = 'vault/'.$request->main_directory.'/'. $folder;
            $sub_folders = '2' ;

            if (file_exists(public_path().'/'.$path)) {
              
            } else {
               
                File::makeDirectory(public_path().'/'.$path, $mode = 0777, true, true);
            }
            
        }
        else{
            $path ='vault/'.$request->main_directory; 
            $sub_folders = '1' ;
        }

        if(Vault::where('name', $request->name)->where('sub_folders', $sub_folders)->exists()){
             
             return redirect()->back()->withMessage('Document name already exists. Please use different name');

            }


       // print_r($path); die();

        if($file = $request->hasFile('file')) {

            foreach($_FILES['file']['name'] as $key=>$val){ 
                
            $fileName = basename($_FILES['file']['name'][$key]); 
            $temp = explode(".", $fileName);
                 
            $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/'.$path.'/'.$fileName ;
           // print_r($destinationPath); die();
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);

           // $imagearray[] = $fileName ;

             $vault = Vault::create([
                'name' => $temp[0],
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $fileName ,
            ]); 

             $footprint = FootPrint::create([
                    'action' => 'New File uploaded - '.$path.'/'.$temp[0]. '.' . end($temp),
                    'user_id' => Auth::user()->id,
                    'module' => 'Vault',
                    'operation' => 'C'
                ]); 
                 
            }
             
                 
            }
         
       // $imageNames = implode(',', $imagearray);

       

       // print_r($path); die();
        return redirect()->back();
           
        }
        else{
         
          return redirect()->back();
        } 

    }

    public function save_sub_sub_directory_files(Request $request){
       // print_r($request->Input()); die();
        if($request->hasFile('file')){

        $imagearray= array();
        if($request->directory != ''){
            $folder =  $request->directory ;
        }
        else if($request->folder_name != ''){
            $folder =  $request->folder_name ;
        }
        else{
            $folder = '';
        }


        if($folder != ''){
            $path = 'vault/'.$request->main_directory.'/'.$request->sub_directory.'/'. $folder;
            $sub_folders = '3' ;

            if (file_exists(public_path().'/'.$path)) {
              
            } else {
               
                File::makeDirectory(public_path().'/'.$path, $mode = 0777, true, true);
            }
            
        }
        else{
            $path ='vault/'.$request->main_directory.'/'.$request->sub_directory; 
            $sub_folders = '3' ;
        }

        if(Vault::where('name', $request->name)->where('sub_folders', $sub_folders)->exists()){
             
             return redirect()->back()->withMessage('Document name already exists. Please use different name');

            }


       // print_r($path); die();

        if($file = $request->hasFile('file')) {
         // print_r("ll"); die();

            foreach($_FILES['file']['name'] as $key=>$val){ 
                
            $fileName = basename($_FILES['file']['name'][$key]); 
            $temp = explode(".", $fileName);
                 
            $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/'.$path.'/'.$fileName ;
           // print_r($destinationPath); die();
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);

            //$imagearray[] = $fileName ;
             $vault = Vault::create([
                'name' => $temp[0],
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $fileName ,
            ]); 

             $footprint = FootPrint::create([
                    'action' => 'New File uploaded - '.$path.'/'.$temp[0]. '.' . end($temp),
                    'user_id' => Auth::user()->id,
                    'module' => 'Vault',
                    'operation' => 'C'
                ]); 
                 
            }
             
                 
            }
          
         


        /*$imageNames = implode(',', $imagearray);

        $vault = Vault::create([
                'name' => $request->name,
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $imageNames ,
            ]); */

       // print_r($path); die();
        return redirect()->back();
           
        }
        else{
         
          return redirect()->back();
        } 

    }

    public function save_level3_files(Request $request){
       // print_r($request->Input()); die();
        if($request->hasFile('file')){

        $imagearray= array();
        if($request->directory != ''){
            $folder =  $request->directory ;
        }
        else if($request->folder_name != ''){
            $folder =  $request->folder_name ;
        }
        else{
            $folder = '';
        }


        if($folder != ''){
            $path = 'vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'. $folder;
            $sub_folders = '4' ;

            if (file_exists(public_path().'/'.$path)) {
              
            } else {
               
                File::makeDirectory(public_path().'/'.$path, $mode = 0777, true, true);
            }
            
        }
        else{
            $path ='vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3; 
            $sub_folders = '4' ;
        }

        if(Vault::where('name', $request->name)->where('sub_folders', $sub_folders)->exists()){
             
             return redirect()->back()->withMessage('Document name already exists. Please use different name');

            }


        //print_r($path); die();

        if($file = $request->hasFile('file')) {
         // print_r("ll"); die();

            foreach($_FILES['file']['name'] as $key=>$val){ 
                
            $fileName = basename($_FILES['file']['name'][$key]); 
            $temp = explode(".", $fileName);
                 
            $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/'.$path.'/'.$fileName ;
           // print_r($destinationPath); die();
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);

            //$imagearray[] = $fileName ;
             $vault = Vault::create([
                'name' => $temp[0],
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $fileName ,
            ]); 

             $footprint = FootPrint::create([
                    'action' => 'New File uploaded - '.$path.'/'.$temp[0]. '.' . end($temp),
                    'user_id' => Auth::user()->id,
                    'module' => 'Vault',
                    'operation' => 'C'
                ]); 
                 
            }
             
                 
            }
          
          


        /*$imageNames = implode(',', $imagearray);

        $vault = Vault::create([
                'name' => $request->name,
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $imageNames ,
            ]); */

       // print_r($path); die();
        return redirect()->back();
           
        }
        else{
         
          return redirect()->back();
        } 

    }

    public function save_level4_files(Request $request){
       // print_r($request->Input()); die();
        if($request->hasFile('file')){

        $imagearray= array();
        if($request->directory != ''){
            $folder =  $request->directory ;
        }
        else if($request->folder_name != ''){
            $folder =  $request->folder_name ;
        }
        else{
            $folder = '';
        }


        if($folder != ''){
            $path = 'vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->f4.'/'. $folder;
            $sub_folders = '5' ;

            if (file_exists(public_path().'/'.$path)) {
              
            } else {
               
                File::makeDirectory(public_path().'/'.$path, $mode = 0777, true, true);
            }
            
        }
        else{
            $path ='vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->f4; 
            $sub_folders = '5' ;
        }

        if(Vault::where('name', $request->name)->where('sub_folders', $sub_folders)->exists()){
             
             return redirect()->back()->withMessage('Document name already exists. Please use different name');

            }


        //print_r($path); die();

        if($file = $request->hasFile('file')) {
         // print_r("ll"); die();

            foreach($_FILES['file']['name'] as $key=>$val){ 
                
            $fileName = basename($_FILES['file']['name'][$key]); 
            $temp = explode(".", $fileName);
                 
            $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/'.$path.'/'.$fileName ;
           // print_r($destinationPath); die();
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);

            //$imagearray[] = $fileName ;
             $vault = Vault::create([
                'name' => $temp[0],
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $fileName ,
            ]); 

             $footprint = FootPrint::create([
                    'action' => 'New File uploaded - '.$path.'/'.$temp[0]. '.' . end($temp),
                    'user_id' => Auth::user()->id,
                    'module' => 'Vault',
                    'operation' => 'C'
                ]); 
                 
            }
             
                 
            }
          
          


        /*$imageNames = implode(',', $imagearray);

        $vault = Vault::create([
                'name' => $request->name,
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $imageNames ,
            ]); */

       // print_r($path); die();
        return redirect()->back();
           
        }
        else{
         
          return redirect()->back();
        } 

    }


    public function save_level5_files(Request $request){
       // print_r($request->Input()); die();
        if($request->hasFile('file')){

        $imagearray= array();
        if($request->directory != ''){
            $folder =  $request->directory ;
        }
        else if($request->folder_name != ''){
            $folder =  $request->folder_name ;
        }
        else{
            $folder = '';
        }


        if($folder != ''){
            $path = 'vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->f4.'/'.$request->f5.'/'. $folder;
            $sub_folders = '6' ;

            if (file_exists(public_path().'/'.$path)) {
              
            } else {
               
                File::makeDirectory(public_path().'/'.$path, $mode = 0777, true, true);
            }
           
        }
        else{
            $path ='vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->f4.'/'.$request->f5; 
            $sub_folders = '6' ;
        }

        if(Vault::where('name', $request->name)->where('sub_folders', $sub_folders)->exists()){
             
             return redirect()->back()->withMessage('Document name already exists. Please use different name');

            }


        //print_r($path); die();

        if($file = $request->hasFile('file')) {
         // print_r("ll"); die();

            foreach($_FILES['file']['name'] as $key=>$val){ 
                
            $fileName = basename($_FILES['file']['name'][$key]); 
            $temp = explode(".", $fileName);
                 
            $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/'.$path.'/'.$fileName ;
           // print_r($destinationPath); die();
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);

            //$imagearray[] = $fileName ;
             $vault = Vault::create([
                'name' => $temp[0],
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $fileName ,
            ]); 

             $footprint = FootPrint::create([
                    'action' => 'New File uploaded - '.$path.'/'.$temp[0]. '.' . end($temp),
                    'user_id' => Auth::user()->id,
                    'module' => 'Vault',
                    'operation' => 'C'
                ]); 
                 
            }
             
                 
            }
          
          


        /*$imageNames = implode(',', $imagearray);

        $vault = Vault::create([
                'name' => $request->name,
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $imageNames ,
            ]); */

       // print_r($path); die();
        return redirect()->back();
           
        }
        else{
         
          return redirect()->back();
        } 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        if($file = $request->hasFile('file')) {

             
            $file = $request->file('file') ;
            $fileName = $file->getClientOriginalName() ;
          
            if(Vault::exists()){
                 $id = Vault::select('id')->orderBy('id', 'DESC')->first();
                 
                 $file_name = "DOC_".++$id->id;
                 
            }
            else {
                $file_name = "DOC_01";
            }

            $temp = explode(".", $file->getClientOriginalName());
            $fileName=$file_name . '.' . end($temp);
           
            $destinationPath = public_path().'/vault' ;
            $file->move($destinationPath,$fileName);

          //  print_r($fileName);die();
            $vault = Vault::create([
                'name' => $request->name,
                'type' => end($temp),
                'filename'=> $fileName ,
            ]);

           
            
          }

          return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function show(Vault $vault)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function edit(Vault $vault)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      // print_r($request->Input());die();

        $files = Vault::where('id', $request->id)->first(); 

       $vault = Vault::where('id', $request->id)->update(['name' => $request->name]);

       $footprint = FootPrint::create([
                    'action' => 'File renamed - '.$files->folder.'/'.$files->name.' to '.$request->name,
                    'user_id' => Auth::user()->id,
                    'module' => 'Vault',
                    'operation' => 'U'
                ]);

       return redirect()->back();
    }

    public function update_foldername(Request $request){
        print_r($request->Input()); 

        if($request->sub_folders == '1'){
            // print_r("1"); die();
            $data = Vault::where('folder','LIKE','vault/'.$request->old_name.'%')->get();
            $isrenamed = 'false' ;
            foreach ($data as $key => $value) {
                $folder_structure = $value->folder;
               
                $arr = explode('/',$folder_structure);
               
                if($isrenamed == 'false'){
                     rename(public_path('/vault/'.$arr[$request->sub_folders]), public_path('/vault/'.$request->name)); 
                     $old_name = $arr[$request->sub_folders];
                     $isrenamed = 'true' ;
                }

               // print_r($old_name); die();
                     
                $arr[$request->sub_folders] = $request->name; 
                
                $updated_struc = implode('/',$arr);
             
                $update = Vault::where('id', $value->id)
                ->where('sub_folders','!=','0')
                ->where('folder','LIKE','vault/'.$request->old_name.'%')
                ->update(['folder' => $updated_struc]);  
        }
     
        }
        elseif($request->sub_folders == '2'){
            //print_r("2"); die();
            $data = Vault::where('folder','LIKE','vault/'.$request->f1.'/'.$request->old_name.'%')->get();
            $isrenamed = 'false' ;
           /* print_r("<br>");
            print_r(json_encode($data)); die();*/
            foreach ($data as $key => $value) {
                $folder_structure = $value->folder;
               
                $arr = explode('/',$folder_structure);
               
                if($isrenamed == 'false'){
                     rename(public_path('/vault/'.$request->f1.'/'.$arr[$request->sub_folders]), public_path('/vault/'.$request->f1.'/'.$request->name)); 
                     $old_name = $arr[$request->sub_folders];
                     $isrenamed = 'true' ;
                }

               // print_r($old_name); die();
                     
                $arr[$request->sub_folders] = $request->name; 
                
                $updated_struc = implode('/',$arr);
             
                $update = Vault::where('id', $value->id)
                ->where('sub_folders','!=','0')
                ->where('folder','LIKE','vault/'.$request->f1.'/'.$request->old_name.'%')
                ->update(['folder' => $updated_struc]);  
            }
 
        }
         elseif($request->sub_folders == '3'){
            // print_r("3"); die();
            $data = Vault::where('folder','LIKE','vault/'.$request->f1.'/'.$request->f2.'/'.$request->old_name.'%')->get();
            $isrenamed = 'false' ;
           /* print_r("<br>");
            print_r(json_encode($data)); die();*/
            foreach ($data as $key => $value) {
                $folder_structure = $value->folder;
               
                $arr = explode('/',$folder_structure);
               
                if($isrenamed == 'false'){
                     rename(public_path('/vault/'.$request->f1.'/'.$request->f2.'/'.$arr[$request->sub_folders]), public_path('/vault/'.$request->f1.'/'.$request->f2.'/'.$request->name)); 
                     $old_name = $arr[$request->sub_folders];
                     $isrenamed = 'true' ;
                }

               // print_r($old_name); die();
                     
                $arr[$request->sub_folders] = $request->name; 
                
                $updated_struc = implode('/',$arr);
             
                $update = Vault::where('id', $value->id)
                ->where('sub_folders','!=','0')
                ->where('folder','LIKE','vault/'.$request->f1.'/'.$request->f2.'/'.$request->old_name.'%')
                ->update(['folder' => $updated_struc]);  
            }
 
        }
         elseif($request->sub_folders == '4'){
            // print_r("4"); die();
             $data = Vault::where('folder','LIKE','vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->old_name.'%')->get();
            $isrenamed = 'false' ;
           /* print_r("<br>");
            print_r(json_encode($data)); die();*/
            foreach ($data as $key => $value) {
                $folder_structure = $value->folder;
               
                $arr = explode('/',$folder_structure);
               
                if($isrenamed == 'false'){
                     rename(public_path('/vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$arr[$request->sub_folders]), public_path('/vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->name)); 
                     $old_name = $arr[$request->sub_folders];
                     $isrenamed = 'true' ;
                }

               // print_r($old_name); die();
                     
                $arr[$request->sub_folders] = $request->name; 
                
                $updated_struc = implode('/',$arr);
             
                $update = Vault::where('id', $value->id)
                ->where('sub_folders','!=','0')
                ->where('folder','LIKE','vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->old_name.'%')
                ->update(['folder' => $updated_struc]);  
            }
 
        }
         elseif($request->sub_folders == '5'){
            // print_r("5"); die();
              $data = Vault::where('folder','LIKE','vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->f4.'/'.$request->old_name.'%')->get();
            $isrenamed = 'false' ;
           /* print_r("<br>");
            print_r(json_encode($data)); die();*/
            foreach ($data as $key => $value) {
                $folder_structure = $value->folder;
               
                $arr = explode('/',$folder_structure);
               
                if($isrenamed == 'false'){
                     rename(public_path('/vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->f4.'/'.$arr[$request->sub_folders]), public_path('/vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->f4.'/'.$request->name)); 
                     $old_name = $arr[$request->sub_folders];
                     $isrenamed = 'true' ;
                }

               // print_r($old_name); die();
                     
                $arr[$request->sub_folders] = $request->name; 
                
                $updated_struc = implode('/',$arr);
             
                $update = Vault::where('id', $value->id)
                ->where('sub_folders','!=','0')
                ->where('folder','LIKE','vault/'.$request->f1.'/'.$request->f2.'/'.$request->f3.'/'.$request->f4.'/'.$request->old_name.'%')
                ->update(['folder' => $updated_struc]);  
            }
 
        }
       
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$vault = Vault::where('id', $id)->delete();
        $files = Vault::where('id', $id)->first(); 

        $vault = Vault::where('id', $id)->update(['filename' => '']);

        $footprint = FootPrint::create([
                    'action' => 'File deleted - '.$files->folder.'/'.$files->name.'.'.$files->type,
                    'user_id' => Auth::user()->id,
                    'module' => 'Vault',
                    'operation' => 'U'
                ]);

       return redirect()->back();


    }
}
