<?php

namespace App\Http\Controllers;

use App\Models\Vault;
use Illuminate\Http\Request;
use File;

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
        $data = Vault::where('folder','vault')->get();

        
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
        $data = Vault::where('folder','LIKE','vault/'.$foldername)->get();

        
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
        /*$folders = Vault::select('folder')->groupBy('folder')->where('sub_folders','2')->where('folder','LIKE','vault/'.$foldername.'/%')->get();*/
       
        $data = Vault::where('folder','LIKE','vault/'.$foldername.'/'.$sub_folder_name.'%')->get();

        return view('vault/sub_sub_directory',compact('data' , 'foldername','sub_folder_name'));

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
                 
            $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/'.$path.'/'.$fileName ;
           // print_r($destinationPath); die();
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);

            $imagearray[] = $fileName ;
             
                 
            }
          
          }


        $imageNames = implode(',', $imagearray);

        $vault = Vault::create([
                'name' => $request->name,
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $imageNames ,
            ]); 

       // print_r($path); die();
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

            $imagearray[] = $fileName ;
             
                 
            }
          
          }


        $imageNames = implode(',', $imagearray);

        $vault = Vault::create([
                'name' => $request->name,
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $imageNames ,
            ]); 

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
            $sub_folders = '2' ;
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

            $imagearray[] = $fileName ;
             
                 
            }
          
          }


        $imageNames = implode(',', $imagearray);

        $vault = Vault::create([
                'name' => $request->name,
                'type' => end($temp),
                'sub_folders' => $sub_folders,
                'folder' => $path,
                'filename'=> $imageNames ,
            ]); 

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
       //print_r($request->Input());die();

       $vault = Vault::where('id', $request->id)->update(['name' => $request->name]);
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
        $vault = Vault::where('id', $id)->delete();
       return redirect()->back();
    }
}
