<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Indent_list;
use App\Models\Pcn;
use App\Models\GRN;
use App\Models\User;
use App\Models\Material;
use App\Models\Category;

//use Illuminate\Support\Facades\Mail;
use App\Mail\IndentsMail;
use PDF;
use SendGrid\Mail\From;
use SendGrid\Mail\To;
use SendGrid\Mail\Mail;

class IndentController extends Controller
{
   
   function create(Request $request){

   //	 print_r($request->Input());die();

   	 if(isset($request->user_id) && isset($request->pcn) && isset($request->indents))
   	 {
       
        if(!empty($request->indents)){

          if(Intend::exists()){
          	$Indent = Intend::select('indent_no')->orderBy('id', 'DESC')->first();

             $arr = explode("MI00", $Indent->indent_no);
           
          	$ind_no = "MI00".++$arr[1];

           //  print_r($indent_no);die();
          }
          else {
          	$ind_no = "MI001" ;
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
              'name' => $value->materials->name ,
              'brand' => $value->materials->brand ,
              'decription' => $value->decription,
              'quantity' => $value->quantity,
             ];
           }

          
           $indent_details = [
                 'indent_no' => $idtend->indent_no,
                 'pcn' => $idtend->pcn ,
                 'details'=> $data     
          ];

        
        $file = 'HRE_'.$idtend->indent_no.'.pdf';
          
        $pdf = PDF::loadView('pdf.indentsPDF', $indent_details);
      
        $pdf->save(public_path('pdf/'.$file));
/*
        $path = public_path('pdf');
        $filename = $path.'/'.$file;
        Mail::to('druva@netiapps.com')->send(new IndentsMail($indent_details , $filename));
*/
        /*$userdetails = User::where('id', $request->user_id)->first();
        $pcn_details = Pcn::where('pcn',$request->pcn)->first();

        $from = new From("abhishek@netiapps.com", "HRE");
                $tos = [
                    new To(
                        "druva@netiapps.com",
                        "Druva",
                       
                        [
                            'indent_no' => $idtend->indent_no,
                            'pcn' => $idtend->pcn,
                            'name' => 'Druva',
                            'supervisor' => $userdetails->name,
                            'client_name' => $pcn_details->client_name,
                            'brand' => $pcn_details->brand,
                            'client_location' => $pcn_details->area.",".$pcn_details->city.",",$pcn_details->state
                        ]
                        
                    )
                ];

              
                $email = new Mail(
                    $from,
                    $tos
                );
                $email->setTemplateId("d-03a5c49c9835443c9bfa4f0df5475e7f");
                
                $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
                try {
                    $response = $sendgrid->send($email);
                     print $response->statusCode() . "\n";
                     print_r($response->headers());
                     print $response->body() . "\n"; die();
                } catch (Exception $e) {
                    echo 'Caught exception: '.  $e->getMessage(). "\n";
                } 

*/

        return response()->json([
         	 		'status' => 1 ,
         	 		'message' => 'Indent Created Succesfully'
         	 		]);
        }

        else {
            return response()->json([
           	 		'status' => 0 ,
           	 		'message' => 'Indent array is empty' 
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

   function indents(Request $request){
    $indentarray=array();
      if(!isset($request->user_id)){
        return response()->json([
              'status' => 0 ,
              'message' => 'UnAuthorized' ,
              'data' => $indentarray
              ]);
      }
      else {
        $indents = Intend::where('user_id',$request->user_id)->where('status','!=','Completed')->get();
        

        foreach ($indents as $key => $value) {
          $indentarray[] = [
            'indent_id' => $value->id ,
            'indent_no' => $value->indent_no,
            'pcn' => $value->pcn,
            'status'=> $value->status,
            'created_on' => $value->created_at->toDateTimeString()

          ];
              
        }
        return response()->json([
              'status' => 1 ,
              'message' => 'success' ,
              'data' => $indentarray
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
      $Pcns = Pcn::where('status','Active')->get();
      
      foreach ($Pcns as $key => $value) {
      $pcn_array[] = [
        'pcn'=> $value->pcn,
        'client_name'=>$value->client_name,
        'brand' => $value->brand,
        'location' => $value->location,
        'area' => $value->area,
        'city' => $value->city
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

          $grns = GRN::where('user_id',$user_id)->where('status','!=','Received')->get();

          if(sizeof($grns)>0){

           

          foreach ($grns as $key => $value) {

            $indent_list = Indent_list::where('id',$value->indent_list_id)->first();

            $material = Material::where('item_code',$indent_list->material_id)->first();
            
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
              'indent_no' => $value->indent_no,
              'dispatched' => $value->dispatched,
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

   function getdepartments(Request $request){

    $data= array();
    if(isset($request->user_id)){
        $data = Category::select('category')->get();

        return response()->json([
          'status' => 1 ,
          'message' => 'success',
          'data' => $data
        ]);

    }
    else {
      return response()->json([
                  'status' => 0 ,
                  'message' => 'UnAuthorized/Insufficient data',
                  'data' => $data
                  ]);
    }

   }
}
