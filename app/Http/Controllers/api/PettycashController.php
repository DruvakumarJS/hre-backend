<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pettycash;
use App\Models\PettyCashDetail;

class PettycashController extends Controller
{
     public function mypettycash(Request $request){
          
          if(isset($request->user_id)){
          	$data = PettyCash::where('user_id' , $request->user_id)->orderBy('id', 'DESC')->get();

          	$casharray = array();

          	foreach ($data as $key => $value) {
          		$result = [
          			'date' => $value->created_at->toDateTimeString(),
                'pettycash_id' => $value->id,
          			'total_amount' => $value->total ,
          			'purpose' => $value->comments ,
          			'spended_cash' => $value->spend ,
          			'remaining_cash' => $value->remaining ];

                array_push($casharray, $result);			
          		 
          	}

          	return response()->json([
          		'status' => 1,
          		'message' => 'Success',
          		'data' => $casharray]);

          }
          else {

          	return response()->json([
          		'status' => 0,
          		'message' => 'UnAuthorized',
          		'data' => '']);
          }
     }

     public function upload_bill(Request $request){

     	if(isset($request->user_id) && isset($request->pettycash_id) && isset($request->spent_amount)){
     		$fileName='';
            $bill_no = 'PC00';

            if(PettyCashDetail::exists()){
                 $conversation_id = PettyCashDetail::select('id')->orderBy('id', 'DESC')->first();                 
                 $bill_no= "PC00".++$conversation_id->id;
            }
            else{                 
                 $bill_no= 'PC001';                
            }

            if($file = $request->hasFile('bill')) {
           
            $file = $request->file('bill') ;
            //$fileName = $file->getClientOriginalName() ;
             $temp = explode(".", $file->getClientOriginalName());
             $fileName=$bill_no . '.' . end($temp);
        
            $destinationPath = public_path().'/pettycashfiles' ;
            $file->move($destinationPath,$fileName);
  
          }

          $createData = PettyCashDetail::create([
                'pettycash_id' => $request->pettycash_id,
                'billing_no' => $bill_no ,
                'spent_amount' => $request->spent_amount ,
                'comments' => $request->comment,
                'filename' => $fileName,
                'isapproved' => '0'
            ]);

          if($createData){
          	return response()->json([
          		'status' => 1,
          		'message' => 'Success'
          		]);
          }

          else{
          	return response()->json([
          		'status' => 0,
          		'message' => 'Something went wrong'
          		]);
          }


     	}

     	else {

     		return response()->json([
          		'status' => 0,
          		'message' => 'UnAuthorized / Insufficient Input'
          		]);
     	}
     	
     }

     public function pettycash_details(Request $request){

     	if(isset($request->user_id) && isset($request->pettycash_id)){

     		$data = PettyCashDetail::where('pettycash_id' , $request->pettycash_id)->orderBy('id', 'DESC')->get();

     		$details=array();

     		foreach ($data as $key => $value) {
     			$approved ="";
     			if($value->isapproved=='0'){
     				$approved = 'Waiting for approval';
     			}
     			else if($value->isapproved=='1'){
     				$approved = 'Accepted';
     			}
     			else if($value->isapproved=='2') {
                     $approved = 'Rejected';
     			}
     			else {

     			}

     			$details[]=[
     				'date' => $value->created_at->toDateTimeString(),
     				'spent_amount' => $value->spent_amount ,
     				'comments' => $value->comments, 
     				'filepath' => 'https://hre.netiapps.com/pettycashfiles/',
     				'filename' => $value->filename,
     				'isapproved'=> $approved
     			];
     		}

     		return response()->json([
          		'status' => 1,
          		'message' => 'Success',
          		'data' => $details
          		]);



     	}
     	else {
     		return response()->json([
          		'status' => 0,
          		'message' => 'UnAuthorized / Insufficient Input',
          		'data' => ''
          		]);

     	}

     }
}
