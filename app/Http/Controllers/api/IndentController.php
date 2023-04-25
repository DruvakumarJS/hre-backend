<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Indent_list;
use App\Models\Pcn;
use App\Models\GRN;
use App\Models\Material;

class IndentController extends Controller
{
   
   function create(Request $request){

   //	 print_r($request->Input());die();

   	 if(isset($request->user_id) && isset($request->pcn) && isset($request->indents))
   	 {
       
        if(!empty($request->indents)){

          if(Intend::exists()){
          	$Indent = Intend::select('indent_no')->orderBy('id', 'DESC')->first();
           
          	$ind_no = ++$Indent->indent_no ;

           //  print_r($indent_no);die();
          }
          else {
          	$ind_no = "IN001" ;
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


        return response()->json([
         	 		'status' => 1 ,
         	 		'message' => 'Indent Created Succesfully',
              'inputs' => json_encode($request->Input())
         	 		]);
        }

        else {
            return response()->json([
           	 		'status' => 0 ,
           	 		'message' => 'Indent array is empty' ,
                'inputs' => json_encode($request->Input())
           	 ]);
        }
   	 }

   	 else {

     	 	return response()->json([
         	 		'status' => 0 ,
         	 		'message' => 'Insufficient inputs' ,
              'inputs' => json_encode($request->Input())
         	 		]);
     	 }

      

   }

   function pcn_list(Request $request){

     if(isset($request->user_id))
     {
      $Pcns = Pcn::get();

      foreach ($Pcns as $key => $value) {
      $pcn_array[] = [
        'pcn'=> $value->pcn,
        'client_name'=>$value->client_name,
        'type+of_work' => $value->work,
        'area' => $value->area,
        'city' => $value->city,
        'state' => $value->state
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
                    'message' => 'Unauthorized',
                    'data'=> ""]);
     }


   }

   function grn_list(Request $request){

        if(isset($request->user_id))
        {
          $user_id = $request->user_id ;

          $grns = GRN::where('user_id',$user_id)->where('status','!=','Received')->get();

          if(sizeof($grns)>0){

            $grn_array = array();

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
                        'data'=> ""]);

          }

          

        }
        else {

           return response()->json([
                        'status' => 0 ,
                        'message' => 'Unauthorized',
                        'data'=> ""]);
        }

        

   }

   function update_grn(Request $request){

      if(isset($request->user_id) && isset($request->grn) && isset($request->approved)){
        $approved =$request->approved;

        $update_grn_data = GRN::where('grn',$request->grn)->update([
                                       'approved'=> $approved,
                                       'damaged' => $request->rejected,
                                       'dispatched'=>'0',
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
                        'message' => 'Unauthorized/Insufficient data'
                        ]);

      }

       

   }
}
