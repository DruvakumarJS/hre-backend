<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Indent_list;
use App\Models\Pcn;
use App\Models\GRN;
use App\Models\User;
use App\Models\Employee;
use App\Models\Material;
use App\Models\Category;
use App\Models\Roles;
use App\Models\FootPrint;

//use Illuminate\Support\Facades\Mail;
use App\Mail\IndentsMail;
use PDF;

use Mail;

class IndentController extends Controller
{
   
   function create(Request $request){

   //	 print_r($request->Input());die();

   	 if(isset($request->user_id) && isset($request->pcn) && isset($request->indents))
   	 {
       
        if(!empty($request->indents)){

          if(Intend::exists()){
          	$Indent = Intend::select('indent_no')->orderBy('id', 'DESC')->first();

             $arr = explode("MI_00", $Indent->indent_no);
           
          	$ind_no = "MI_00".++$arr[1];

           //  print_r($indent_no);die();
          }
          else {
          	$ind_no = "MI_001" ;
          }

          $indent_array = $request->indents ; 


          $create_indent = Intend::create([
                                  'indent_no' => $ind_no,
                                  'pcn' => $request->pcn ,
                                  'user_id' => $request->user_id,
                                  'quantity' => "0",
                                  'recieved'=> "0",
                                  'pending'=>"0",
                                  'status'=>'Active'
          ]);

          if($create_indent){
            $indent_id = Intend::select('id')->where('indent_no', $ind_no)->first();

            $totalQualntity = 0;



             foreach ($indent_array as $key => $value) {
          
             $indents = Indent_list::create([
                                  'indent_id' => $indent_id->id,
                                  'material_id' => $value['material_id'],
                                  'decription' => $value['description'],
                                  'quantity' => $value['quantity'],
                                  'recieved'=> "0",
                                  'pending'=>$value['quantity'],
                                  'status'=>'Active']);

             if($indents){
                    if($totalQualntity=="0"){
                      $totalQualntity = $value['quantity'] ;

                    }
                    else {
                      $totalQualntity = intval($totalQualntity) + intval($value['quantity']);

                    }
             }

             }

              $update_indents = Intend::where('indent_no', $ind_no)->update([
                                          'quantity' => $totalQualntity,
                                          'recieved'=> "0",
                                          'pending'=>$totalQualntity,
                                  ]);

          }

          // pdf data


          $idtend= Intend::where('indent_no',$ind_no)->first();
           $pdf_array = Indent_list::where('indent_id' , $idtend->id)->with('materials')->get();

           foreach ($pdf_array as $key => $value) {
             $data[] = [
              'material_id' => $value->material_id ,
              'category' => $value->materials->Category->category,
              'name' => $value->materials->name ,
              'brand' => $value->materials->brand ,
              'quantity' => $value->quantity,
              'comments' => $value->decription,
              'uom'=> $value->materials->uom,
              'features' => $value->materials->information
             ];
           }
          
          $pcn_data=Pcn::where('pcn',$idtend->pcn)->first();

          $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
          $user = User::where('id',$request->user_id)->first();
          
           $indent_details = [
                 'indent_no' => $idtend->indent_no,
                 'pcn' => $idtend->pcn ,
                 'pcn_details'=> $pcn_detail ,
                 'creator' =>$user->name,
                 'details'=> $data     
          ];

          $empl = Employee::select('employee_id')->where('user_id',$request->user_id)->first(); 

          $subject = "New Indent : " .$empl->employee_id." - ".$ind_no ." - ".$request->pcn;

          $emailarray = User::select('email')->whereIn('role_id',['1','10','11','12'])->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

          // SendIndentEmail::dispatch($indent_details,$subject,$emailid);

          $footprint = FootPrint::create([
                  'action' => 'New indent created - '.$ind_no,
                  'user_id' => $request->user_id,
                  'module' => 'Indent',
                  'operation' => 'C',
                  'platform' => 'Android'
              ]);



        return response()->json([
         	 		'status' => 1 ,
         	 		'message' => 'Indent Created Succesfully ',
              'data' => ['indent_no' => $idtend->indent_no,'pcn' =>$idtend->pcn ,'pcn_details'=> $pcn_detail   ]
         	 		]);
        }

        else {
            return response()->json([
           	 		'status' => 0 ,
           	 		'message' => 'Indent array is empty',
                'data' =>[]
           	 ]);
        }
   	 }

   	 else {

     	 	return response()->json([
         	 		'status' => 0 ,
         	 		'message' => 'Insufficient inputs' 
         	 		]);
     	 }    

   }

   function indents_backup(Request $request){
    $indentarray=array();
    $final_array=array();
      if(!isset($request->user_id)){
        return response()->json([
              'status' => 0 ,
              'message' => 'UnAuthorized' ,
              'data' => $indentarray
              ]);
      }
      else {
        $user = User::where('id',$request->user_id)->first();
        $role_id = $user->role_id ;

        if($role_id == '4'){
           $indents = Intend::where('user_id',$request->user_id)->get();
       
        $indent_active = Intend::where('user_id',$request->user_id)->where('status','Active')->count();
        $indent_completed = Intend::where('user_id',$request->user_id)->where('status','Completed')->count();

        $counts=['Active' => $indent_active , 'Completed' => $indent_completed ];
        

        foreach ($indents as $key => $value) {
         $pcn_data=Pcn::where('pcn',$value->pcn)->first();

         $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;

          $indentarray[] = [
            'indent_id' => $value->id ,
            'indent_no' => $value->indent_no,
            'pcn' => $value->pcn,
            'pcn_detail' => $pcn_detail,
            'status'=> $value->status,
            'created_on' => $value->created_at->toDateTimeString()

          ];
              
        }
       }
        else {
           $indents = Intend::get();
       
        $indent_active = Intend::where('status','Active')->count();
        $indent_completed = Intend::where('status','Completed')->count();

        $counts=['Active' => $indent_active , 'Completed' => $indent_completed ];
        

        foreach ($indents as $key => $value) {
         $pcn_data=Pcn::where('pcn',$value->pcn)->first();

         $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;

          $indentarray[] = [
            'indent_id' => $value->id ,
            'indent_no' => $value->indent_no,
            'pcn' => $value->pcn,
            'pcn_detail' => $pcn_detail,
            'status'=> $value->status,
            'created_on' => $value->created_at->toDateTimeString()

          ];
              
        }
        }
           
            $final_array=['counts' => $counts , 'myindents' => $indentarray];

              return response()->json([
                    'status' => 1 ,
                    'message' => 'success' ,
                    'data' => $final_array
                    ]);

        }
       
      

   }

   function indents(Request $request){

    $indentarray=array();
    $final_array=array();

    if(!isset($request->user_id)){
        
        return response()->json([
              'status' => 0 ,
              'message' => 'UnAuthorized' ,
              'data' => $indentarray
              ]);
      }
      else {
    
        $user = User::where('id' , $request->user_id)->first();

        $role_id = $user->role_id ;
       
        if($role_id == 1 OR $role_id == 2 OR $role_id == 10 OR $role_id == 11 OR $role_id == 12) {
            $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->orderBy('created_at', 'ASC')->get();

            $all = Intend::count();
            $activeCount = Intend::where('status','Active')->count();
            
            $compltedCount = Intend::where('status','Completed')->count();
           }
           elseif($role_id == 3 OR $role_id == 4 OR $role_id == 5){

            $role = Roles::select('id')->where('team_id','3')->get();
                $emp= array();
                foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                  
                }

            $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->whereIn('user_id',$userIDs)->orderBy('created_at', 'ASC')->get();

            $all = Intend::whereIn('user_id',$userIDs)->count();
            $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
            
            $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
               

           }
           elseif($role_id == 6 OR $role_id == 7 OR $role_id == 8 OR $role_id == 9){

            $role = Roles::select('id')->where('team_id','4')->get();
                $emp= array();
                foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                  
                }

            $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")->whereIn('user_id',$userIDs)->orderBy('created_at', 'ASC')->get();

            $all = Intend::whereIn('user_id',$userIDs)->count();
            $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
            
            $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
               

           }
           else {
            $indents=Intend::where('user_id' ,$request->user_id)->get();
            $all = Intend::where('user_id' ,$request->user_id)->count();
            $activeCount = Intend::where('user_id' ,$request->user_id)->where('status','Active')->count();
          
            $compltedCount = Intend::where('user_id' ,$request->user_id)->where('status','Completed')->count();
           }

            $counts=[ 'Active' => $activeCount , 'Completed' => $compltedCount ];

            foreach ($indents as $key => $value) {
             $pcn_data=Pcn::where('pcn',$value->pcn)->first();

             $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
             $empl = Employee::where('user_id',$value->user_id)->first();

              $indentarray[] = [
                'indent_id' => $value->id ,
                'indent_no' => $value->indent_no,
                'pcn' => $value->pcn,
                'pcn_detail' => $pcn_detail,
                'status'=> $value->status,
                'creator_name' => $empl->name,
                'creator_emplid' => $empl->employee_id,
                'created_on' => $value->created_at->toDateTimeString()

              ];
                  
            }

            $final_array=['counts' => $counts , 'myindents' => $indentarray];

            return response()->json([
                'status' => 1 ,
                'message' => 'success' ,
                'data' => $final_array
                ]);
        
     }
   }

   function indent_details(Request $request){

   $indentarray=array();
      if(!isset($request->user_id) || !isset($request->indent_id) ){
        return response()->json([
              'status' => 0 ,
              'message' => 'UnAuthorized' ,
              'data' => $indentarray
              ]);
      }
      else {
        $indents_list = Indent_list::where('indent_id',$request->indent_id)->get();
        

        foreach ($indents_list as $key => $value) {
          $indentarray[] = [
            'indent_id' => $value->indent_id ,
            'material_id' => $value->material_id,
            'material_name' => $value->materials->name,
            'material_brand' => $value->materials->brand,
            'material_info' => json_decode($value->materials->information),
            'decription' => $value->decription,
            'quantity'=> $value->quantity,
            'recieved'=> $value->recieved,
            'pending'=> $value->pending,
            'status'=> $value->status,
            'created_on' => $value->created_at->toDateTimeString(),
            'last_update' => $value->updated_at->toDateTimeString()

          ];
              
        }
        return response()->json([
              'status' => 1 ,
              'message' => 'success' ,
              'data' => $indentarray
              ]);


      }

   }

   function pcn_list(Request $request){

   $pcn_array= array();
     if(isset($request->user_id))
     {
      $Pcns = Pcn::orderBy('pcnumber', 'desc')->get();
      
      foreach ($Pcns as $key => $value) {
      $pcn_array[] = [
        'pcn'=> $value->pcn,
        'client_name'=>$value->client_name,
        'brand' => $value->brand,
        'location' => $value->location,
        'area' => $value->area,
        'city' => $value->city,
         'state' => $value->state,
        'pincode' => $value->pincode,
        'status' => $value->status,
         ];

      }

      return response()->json([
                    'status' => 1 ,
                    'message' => 'success',
                    'data'=> $pcn_array]);
     }
     else {
      return response()->json([
                    'status' => 0 ,
                    'message' => 'UnAuthorized',
                    'data'=>$pcn_array ]);
     }


   }

   function grn_list(Request $request){

         $grn_array = array();

        if(isset($request->user_id))
        {
          $user_id = $request->user_id ;

          $grns = GRN::where('user_id',$user_id)->get();

          if(sizeof($grns)>0){

           
          foreach ($grns as $key => $value) {

            $indent_list = Indent_list::where('id',$value->indent_list_id)->first();

            $material = Material::where('item_code',$indent_list->material_id)->first();

            $pcn_data=Pcn::where('pcn',$value->pcn)->first();

            $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
            
            $material_detail = [
              'material_name' => $material->name,
              'brand' => $material->brand,
              'material_category' => $material->Category->category,
              'information' => json_decode($material->information, true, JSON_UNESCAPED_SLASHES),
              'quantity_raised' => $indent_list->quantity,
              'quantity_received' => $indent_list->recieved,
              'quantity_pending' => $indent_list->pending,

            ];

             $grs_data = [
              'grn' => $value->grn,
              'pcn' => $value->pcn,
              'pcn_detail'=> $pcn_detail,
              'indent_no' => $value->indent_no,
              'dispatched' => $value->dispatched,
              'dispatch_comment' => $value->dispatch_comment,
              'accepted' => $value->approved ,
              'rejected' => $value->damaged,
              'accepting_comment' => $value->comment,
              'status' => $value->status,
              'indent_details' => array($material_detail)
            ];

            array_push($grn_array, $grs_data);
          }

          return response()->json([
                        'status' => 1 ,
                        'message' => 'success',
                        'data'=> $grn_array]);

          }
          else {

            return response()->json([
                        'status' => 1 ,
                        'message' => 'No active GRN available',
                        'data'=> $grn_array ]);

          }

          

        }
        else {

           return response()->json([
                        'status' => 0 ,
                        'message' => 'UnAuthorized',
                        'data'=> $grn_array ]);
        }

        

   }

   function update_grn(Request $request){

      if(isset($request->user_id) && isset($request->grn) && isset($request->approved)){
        $approved =$request->approved;

        $update_grn_data = GRN::where('grn',$request->grn)->update([
                                       'approved'=> $approved,
                                       'damaged' => $request->rejected,
                                       'comment' => $request->comment,
                                       'status' => 'Received'
                                      ]);
        if($update_grn_data){
         
           $GRNdata = GRN::select('indent_list_id', 'indent_no')->where('grn',$request->grn)->first();

           $indent_list = Indent_list::where('id',$GRNdata->indent_list_id)->first();
            
            $pending = intval($indent_list->pending)-intval($request->approved);
            $received = intval($indent_list->recieved)+intval($request->approved);

            if($pending == '0'){
              $status = 'Completed';
            }
            else {
              $status = 'Active';
            }

            $update_indent_list = Indent_list::where('id',$GRNdata->indent_list_id)->update([
                'pending' => $pending,
                'recieved' => $received,
                'status'=> $status]);

            if($update_indent_list){

            $indent_data = Intend::where('indent_no',$GRNdata->indent_no)->first();

            $pending = intval($indent_data->pending)-intval($request->approved);
            $received = intval($indent_data->recieved)+intval($request->approved);

            if($pending == '0'){
              $status = 'Completed';
            }
            else {
              $status = 'Active';
            }

            $update_indent = Intend::where('indent_no',$GRNdata->indent_no)->update([
                'pending' => $pending,
                'recieved' => $received,
                'status'=> $status ]);

            $footprint = FootPrint::create([
                    'action' => 'GRN accepted - '.$request->grn,
                    'user_id' => $request->user_id,
                    'module' => 'GRN',
                    'operation' => 'U',
                    'platform' => 'Android'
                ]);


            return response()->json([
                        'status' => 1 ,
                        'message' => 'updated successfully'
                        ]);

            
               
            }

             

        }
        else {
           return response()->json([
                        'status' => 1 ,
                        'message' => 'Could not update GRN'
                        ]);

        }

            
      }
      else{

        return response()->json([
                        'status' => 0 ,
                        'message' => 'UnAuthorized/Insufficient data'
                        ]);

      }

       

   }

   public function search(Request $request){
    $indentarray=array();
    $user = User::where('id' , $request->user_id)->first();
    $search = $request->search;

        $role_id = $user->role_id ;
       
        if($role_id == 1 OR $role_id == 2 OR $role_id == 10 OR $role_id == 11 OR $role_id == 12) {
            $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")
              ->where('indent_no','LIKE','%'.$search.'%')
              ->orWhere('pcn','LIKE','%'.$search.'%')
              ->orWhereHas('pcns', function ($query) use ($search) {
              $query->where('brand', 'like', '%'.$search.'%');
                 })
            ->orderBy('created_at', 'ASC')->get();

            $all = Intend::count();
            $activeCount = Intend::where('status','Active')->count();
            
            $compltedCount = Intend::where('status','Completed')->count();
           }
           elseif($role_id == 3 OR $role_id == 4 OR $role_id == 5){

            $role = Roles::select('id')->where('team_id','3')->get();
                $emp= array();
                foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                  
                }

            $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")
             ->whereIn('user_id',$userIDs)
             ->where(function($query)use($search){
              $query->where('indent_no','LIKE','%'.$search.'%');
               $query->orWhere('pcn','LIKE','%'.$search.'%');
               $query->orWhereHas('pcns', function ($query) use ($search) {
               $query->where('brand', 'like', '%'.$search.'%');
                 });
             })
             ->orderBy('created_at', 'ASC')
             ->get();

            $all = Intend::whereIn('user_id',$userIDs)->count();
            $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
            
            $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
               

           }
           elseif($role_id == 6 OR $role_id == 7 OR $role_id == 8 OR $role_id == 9){

            $role = Roles::select('id')->where('team_id','4')->get();
                $emp= array();
                foreach ($role as $key => $value) {
                   $emp = Employee::select('user_id')->where('role_id',$value->id)->get();

                   foreach ($emp as $key2 => $value2) {
                     $userIDs[] = $value2->user_id;
                 }
                  
                }

            $indents=Intend::orderByRaw("FIELD(status , 'Active', 'Completed') ASC")
            ->whereIn('user_id',$userIDs)
            ->where(function($query)use($search){
              $query->where('indent_no','LIKE','%'.$search.'%');
               $query->orWhere('pcn','LIKE','%'.$search.'%');
               $query->orWhereHas('pcns', function ($query) use ($search) {
               $query->where('brand', 'like', '%'.$search.'%');
                 });
             })
            ->orderBy('created_at', 'ASC')->get();

            $all = Intend::whereIn('user_id',$userIDs)->count();
            $activeCount = Intend::whereIn('user_id',$userIDs)->where('status','Active')->count();
            
            $compltedCount = Intend::whereIn('user_id',$userIDs)->where('status','Completed')->count();
               

           }
           else {
            $indents=Intend::where('user_id' ,$request->user_id)
            ->where(function($query)use($search){
              $query->where('indent_no','LIKE','%'.$search.'%');
               $query->orWhere('pcn','LIKE','%'.$search.'%');
               $query->orWhereHas('pcns', function ($query) use ($search) {
               $query->where('brand', 'like', '%'.$search.'%');
                 });
             })
            ->get();

            $all = Intend::where('user_id' ,$request->user_id) 
            ->count();

            $activeCount = Intend::where('user_id' ,$request->user_id)
            ->where('status','Active')
            ->count();
          
            $compltedCount = Intend::where('user_id' ,$request->user_id)
            ->where('status','Completed')->count();
           }

            $counts=[ 'Active' => $activeCount , 'Completed' => $compltedCount ];

            foreach ($indents as $key => $value) {
             $pcn_data=Pcn::where('pcn',$value->pcn)->first();

             $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;

              $indentarray[] = [
                'indent_id' => $value->id ,
                'indent_no' => $value->indent_no,
                'pcn' => $value->pcn,
                'pcn_detail' => $pcn_detail,
                'status'=> $value->status,
                'created_on' => $value->created_at->toDateTimeString()

              ];
                  
            }

            $final_array=['counts' => $counts , 'myindents' => $indentarray];

            return response()->json([
                'status' => 1 ,
                'message' => 'success' ,
                'data' => $final_array
                ]);
   }

   public function searching(Request $request){
      $search = $request->search;
      $role_id = Roles::where('name' , $request->role)->first();
      $indentarray = array();
      $user_id = $request->user_id ;
      $final_array=array();

      if($role_id->id != 4 ) {
      //  print_r("lll"); die();

       $indents = Intend::where('indent_no','LIKE','%'.$search.'%')
                        ->orWhere('pcn','LIKE','%'.$search.'%')
                        ->orWhereHas('pcns', function ($query) use ($search) {
                        $query->where('brand', 'like', '%'.$search.'%');
                           })
                        ->get();

         foreach ($indents as $key => $value) {
           $pcn_data=Pcn::where('pcn',$value->pcn)->first();

           $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;

            $indentarray[] = [
              'indent_id' => $value->id ,
              'indent_no' => $value->indent_no,
              'pcn' => $value->pcn,
              'pcn_detail' => $pcn_detail,
              'status'=> $value->status,
              'created_on' => $value->created_at->toDateTimeString()

            ];
                
          }

          $counts = ['Active' => '0' , 'Completed' => '0' ];

          $final_array=['counts' => $counts , 'myindents' => $indentarray];
        
          return response()->json([
                'status' => 1 ,
                'message' => 'success' ,
                'data' => $final_array
                ]);

       }
       else 
       {
        // print_r($role_id->id); die();
         if($search != ''){
          $indents = Intend::where(function($query)use($user_id){
                          $query->where('user_id', $user_id );
                            })
                        ->where('indent_no','LIKE','%'.$search.'%')
                        
                        ->orWhere(function($query)use($search, $user_id){
                          $query->where('pcn','LIKE','%'.$search.'%');
                          $query->where('user_id', $user_id);
                            })
                        ->orWhereHas('pcns', function ($query) use ($search, $user_id) {
                           $query->where('brand', 'like', '%'.$search.'%');
                           $query->where('user_id', $user_id);
                           })
                        
                        ->get();

          foreach ($indents as $key => $value) {
           $pcn_data=Pcn::where('pcn',$value->pcn)->first();

           $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;

            $indentarray[] = [
              'indent_id' => $value->id ,
              'indent_no' => $value->indent_no,
              'pcn' => $value->pcn,
              'pcn_detail' => $pcn_detail,
              'status'=> $value->status,
              'created_on' => $value->created_at->toDateTimeString()

            ];
                
          }
          $counts = ['Active' => '0' , 'Completed' => '0' ];

          $final_array=['counts' => $counts , 'myindents' => $indentarray];
        
          
          return response()->json([
                'status' => 1 ,
                'message' => 'success' ,
                'data' => $final_array
                ]);

                        
         }
         else {
           $indents=Intend::where('user_id' ,$request->user_id )->get();

           foreach ($indents as $key => $value) {
             $pcn_data=Pcn::where('pcn',$value->pcn)->first();

             $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;

              $indentarray[] = [
                'indent_id' => $value->id ,
                'indent_no' => $value->indent_no,
                'pcn' => $value->pcn,
                'pcn_detail' => $pcn_detail,
                'status'=> $value->status,
                'created_on' => $value->created_at->toDateTimeString()

              ];
                  
            }

          $counts = ['Active' => '0' , 'Completed' => '0' ];

          $final_array=['counts' => $counts , 'myindents' => $indentarray];

            return response()->json([
                  'status' => 1 ,
                  'message' => 'success' ,
                  'data' => $final_array
                  ]);

            
         }
      
   }

  }

  public function search_grn(Request $request){
    $search = $request->search ;
      
      $grns = GRN::where('user_id',$request->user_id)
              ->where(function($query)use($search){
                 $query->where('grn', 'LIKE','%'.$search.'%');
                 $query->orWhere('pcn', 'LIKE' ,'%'.$search.'%');
                 $query->orWhere('indent_no', 'LIKE' ,'%'.$search.'%');

              })
              ->orderBy('id', 'DESC')
              ->get();
        $grn_array = array();

        if(sizeof($grns)>0){

          foreach ($grns as $key => $value) {

             $indent_list = Indent_list::where('id',$value->indent_list_id)->first();

            $material = Material::where('item_code',$indent_list->material_id)->first();

            $pcn_data=Pcn::where('pcn',$value->pcn)->first();

            $pcn_detail = $pcn_data->brand." , ".$pcn_data->location." , ".$pcn_data->area." , ".$pcn_data->city;
            
            $material_detail = [
              'material_name' => $material->name,
              'brand' => $material->brand,
              'information' => json_decode($material->information, true, JSON_UNESCAPED_SLASHES),
              'quantity_raised' => $indent_list->quantity,
              'quantity_received' => $indent_list->recieved,
              'quantity_pending' => $indent_list->pending,

            ];

             $grs_data = [
              'grn' => $value->grn,
              'pcn' => $value->pcn,
              'pcn_detail'=> $pcn_detail,
              'indent_no' => $value->indent_no,
              'dispatched' => $value->dispatched,
              'dispatch_comment' => $value->dispatch_comment,
              'accepted' => $value->approved ,
              'rejected' => $value->damaged,
              'accepting_comment' => $value->comment,
              'status' => $value->status,
              'indent_details' => array($material_detail)
            ];

            array_push($grn_array, $grs_data);
          }
             return response()->json([
                        'status' => 1 ,
                        'message' => 'success',
                        'data'=> $grn_array]);
         
          }
          else {
             
               return response()->json([
                        'status' => 1 ,
                        'message' => 'No active GRN available',
                        'data'=> $grn_array ]);
          
          }

  }

  public function search_pcn(Request $request){
    $pcn_array=array(); 

    if(Pcn::where('pcn','LIKE','%'.$request->search.'%')->exists()){
       $data = Pcn::where('pcn','LIKE','%'.$request->search.'%')
                    ->orWhere('client_name','LIKE','%'.$request->search.'%')
                    ->orWhere('brand','LIKE','%'.$request->search.'%')
                    ->orWhere('location','LIKE','%'.$request->search.'%')
                    ->orWhere('area','LIKE','%'.$request->search.'%')
                    ->orWhere('city','LIKE','%'.$request->search.'%')
                    ->orWhere('state','LIKE','%'.$request->search.'%')
                    ->orWhere('pincode','LIKE','%'.$request->search.'%')
                    ->get();

       foreach ($data as $key => $value) {
        $pcn_array[] = [
          'pcn'=> $value->pcn,
          'client_name'=>$value->client_name,
          'brand' => $value->brand,
          'location' => $value->location,
          'area' => $value->area,
          'city' => $value->city,
          'state' => $value->state,
          'pincode' => $value->pincode,
          'status' => $value->status,
           ];

        }

        return response()->json([
                      'status' => 1 ,
                      'message' => 'success',
                      'data'=> $pcn_array]);
    }
    else{
       return response()->json([
                        'status' => 0 ,
                        'message' => 'PCN does not exist',
                        'data'=> $pcn_array ]);
    }
   

  }
  
}
