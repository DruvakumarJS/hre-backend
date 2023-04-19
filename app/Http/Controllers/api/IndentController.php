<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intend;
use App\Models\Indent_list;
use App\Models\Pcn;

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
                                  'status'=>'pending'
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
                                  'status'=>'pending']);

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
      $Pcns = Pcn::select('pcn')->get();

      return response()->json([
                    'status' => 1 ,
                    'message' => 'success',
                    'data'=> $Pcns]);
     }
     else {
      return response()->json([
                    'status' => 0 ,
                    'message' => 'Unauthorized',
                    'data'=> ""]);
     }


   }
}
