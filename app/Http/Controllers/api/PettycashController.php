<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pettycash;
use App\Models\PettycashSummary;
use App\Models\PettycashOverview;
use App\Models\PettyCashDetail;
use App\Models\Employee;
use App\Mail\PettycashMail;
use App\Models\Yearendfreeze;
use Mail;

class PettycashController extends Controller
{
     public function mypettycash(Request $request){
          
          if(isset($request->user_id)){
          	$data = PettycashOverview::where('user_id' , $request->user_id)->get();
            $myspent = PettyCashDetail::where('user_id' , $request->user_id)->where('isapproved','!=' , '2')->sum('spent_amount');
        

          	$casharray = array();

          	foreach ($data as $key => $value) {
          		$result = [
          			'issued_amount' => $value->total_issued ,
          			'balance_amount' => $value->total_balance ,
                'my_spend' => $myspent
          			 ];

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
          		'data' => $casharray]);
          }
     }

     public function upload_bill(Request $request){

     	if(isset($request->user_id) && isset($request->bill_date) && isset($request->spent_amount)){

        /* $finaniclyear = date("m") >= 4 ? date("Y"). '-' . (date("Y")+1) : (date("Y") - 1). '-' . date("Y") ;
          if(Yearendfreeze::where('financial_year' ,$finaniclyear)->exists())
          {
            $yearenddate = Yearendfreeze::where('financial_year' ,$finaniclyear)->first(); 
             if(strtotime(date('Y-m-d',strtotime($request->bill_date))) < strtotime($yearenddate->yearend_date)){
             // print_r("cant upload to closed year"); 
              $message = "The bill date is behind account closure date (".date('d-m-Y',strtotime($yearenddate->yearend_date))."). So,You cannot upload a bill ";
              
              return response()->json([
              'status' => 0,
              'message' => $message
              ]);
           }

          }*/
     		
        $fileName='';
        $imagearray=array();
        $bill_no = 'PC00';

         if($file = $request->has('image')) {
         
            foreach($_FILES['image']['name'] as $key=>$val){ 
               
               $fileName = basename($_FILES['image']['name'][$key]); 
                $temp = explode(".", $fileName);
                 
                $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/pettycashfiles/'.$fileName ;
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["image"]["tmp_name"][$key], $destinationPath);

            $imagearray[] = $fileName ;
             
                 
            }
          
          }
     
           $imageNames = implode(',', $imagearray);

           if(PettyCashDetail::exists()){
                 $conversation_id = PettyCashDetail::select('id')->orderBy('id', 'DESC')->first();                 
                 $bill_no= "PC00".++$conversation_id->id;
            }
            else{                 
                 $bill_no= 'PC001';                
            }

          $createData = PettyCashDetail::create([
                'user_id' => $request->user_id,
                'billing_no' => $bill_no ,
                'bill_date' => $request->bill_date ,
                'bill_number' => $request->bill_number ,
                'spent_amount' => $request->spent_amount ,
                'purpose' => $request->purpose ,
                'pcn' => $request->pcn,
                'comments' => $request->comments,
                'filename' => $imageNames,
                'isapproved' => '0'
            ]);

          if($createData){
             $userdetail = Employee::where('user_id',$request->user_id)->first();

          $message = "Your Pettycash Bill of amount Rs.".$request->spent_amount. " dated ".$request->bill_date. " has been submitted successfully . You can check the status of the bill on your Dashboard. https://hre.netiapps.com/pettycash_details/".$request->user_id;

          $p_data= ['name'=> $userdetail->name ,'message' => $message];

          //Mail::to($userdetail->email)->send(new PettycashMail($message));
         // Mail::to('druva@netiapps.com')->send(new PettycashMail($p_data));

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

     	if(isset($request->user_id)){

     		$data = PettyCashDetail::where('user_id' , $request->user_id)->orderBy('id', 'DESC')->get();

     		$details=array();

     		foreach ($data as $key => $value) {
          $images = explode(',', $value->filename);
     			$approved ="";
     			if($value->isapproved=='0'){
     				$approved = 'Awaiting approval';
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
     				'bill_date' => $value->bill_date,
            'utilised_amount' => $value->spent_amount,
            'purpose' => $value->purpose,
     				'pcn' => $value->pcn ,
            'comments' => $value->comments ,
            'bill_submission_date' => $value->created_at->toDateTimeString(),
            'remarks' => $value->remarks,
            'isapproved'=> $approved,
     				'filepath' => url('/').'/pettycashfiles/',
     				'filename' => $images,
     		 
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
          		'data' => $details
          		]);

     	}

     }

    public function fetch_summary(Request $request){

       $data = array();
       if($request->from_date != '' && $request->to_date != '' && $request->user_id != '')
        {
            $data = array();
            $now = strtotime($request->from_date);
            $last = strtotime($request->to_date);

           while($now <= $last ) {

           /* $summary = PettycashSummary::where('user_id',$request->id)->where('created_at','LIKE',date('Y-m-d', $now).'%')->get();
*/
           $summary = PettycashSummary::where('user_id',$request->user_id)->where('transaction_date',date('Y-m-d', $now))->orderBy('id','ASC')->get();

            foreach ($summary as $key => $value) {
                $reference = $value->reference_number;
                $mode = $value->mode;

                if($reference == '' ){
                   $reference = '';
                }

                if($mode == '' ){
                   $mode = '';
                }

                $data[]=[
                    'bill_submission_date' => $value->created_at->toDateTimeString() ,
                    'transaction_date' => \Carbon\Carbon::createFromFormat('Y-m-d', $value->transaction_date)->format('d-m-Y') ,
                    'amount' => $value->amount,
                    'comment' => $value->comment,
                    'type' => $value->type,
                    'mode' => $mode,
                    'ref' => $reference
                ];
              
            
         }

          $now = strtotime('+1 day', $now);
         }
        
         return response()->json([
              'status' => 1,
              'message' => 'Success',
              'data' => $data
              ]);

        }
         else
          {
          
           return response()->json([
              'status' => 0,
              'message' => 'UnAuthorized / Insufficient Input',
              'data' => $data
              ]);

          }
         
        
    }

    public function reminder(Request $request){
      if(isset($request->user_id)){
        $empl = Employee::where('user_id', $request->user_id)->first();
          $p_data = "PettyCash bill approval request : ".$empl->employee_id;

           $emailarray = User::select('email')->where('role_id','5')->orWhere('role_id','1')->get();

                   foreach ($emailarray as $key => $value) {
                      $emailid[]=$value->email;
                   }

          
            try {
                  Mail::to($emailid)->send(new PettycashMail($p_data , $request->user_id));
                } catch (\Exception $e) {
                    return $e->getMessage();
                   
                } 
                finally {
                 
                  return response()->json([
                    'status' => 1,
                    'message' => 'Mail has been sent']);
                }     

      }
      else{
        return response()->json([
                    'status' => 0,
                    'message' => 'UnAuthorized']);

      }
      
     
    }

     public function fetch_summary_with_balance(Request $request){
      $data = array();
       if($request->from_date != '' && $request->to_date != '' && $request->user_id != '')
        {
            $data = array();
            $now = strtotime($request->from_date);
            $last = strtotime($request->to_date);

            $open_credits = PettycashSummary::where('user_id',$request->user_id)->where('transaction_date' ,'<' , date('Y-m-d', $now))->where('type','Credit')->sum('amount');
           $open_debits = PettycashSummary::where('user_id',$request->user_id)->where('transaction_date' ,'<' , date('Y-m-d', $now))->where('type','Debit')->sum('amount');
           $open_balance = intval($open_credits)-intval($open_debits);
           
          // print_r($open_credits ."".$open_debits."=".$open_balance);print_r("<br>"); 
           $close_credits = PettycashSummary::where('user_id',$request->user_id)->where('transaction_date' ,'<=' , date('Y-m-d', $last))->where('type','Credit')->sum('amount');
           $close_debits = PettycashSummary::where('user_id',$request->user_id)->where('transaction_date' ,'<=' , date('Y-m-d', $last))->where('type','Debit')->sum('amount');
           $close_balance = intval($close_credits)-intval($close_debits); 

           while($now <= $last ) {

           /* $summary = PettycashSummary::where('user_id',$request->id)->where('created_at','LIKE',date('Y-m-d', $now).'%')->get();
*/
           $summary = PettycashSummary::where('user_id',$request->user_id)->where('transaction_date',date('Y-m-d', $now))->orderBy('id','ASC')->get();

            foreach ($summary as $key => $value) {
                $reference = $value->reference_number;
                $mode = $value->mode;

                if($reference == '' ){
                   $reference = '';
                }

                if($mode == '' ){
                   $mode = '';
                }

                $data[]=[
                    'bill_submission_date' => $value->created_at->toDateTimeString() ,
                    'transaction_date' => \Carbon\Carbon::createFromFormat('Y-m-d', $value->transaction_date)->format('d-m-Y') ,
                    'amount' => $value->amount,
                    'comment' => $value->comment,
                    'type' => $value->type,
                    'mode' => $mode,
                    'ref' => $reference
                ];
              
            
         }

          $now = strtotime('+1 day', $now);
         }

          $detail = ['opening' => $open_balance , 'closing'=> $close_balance , 'summary' => $data];
        
         return response()->json([
              'status' => 1,
              'message' => 'Success',
              'data' => $detail
              ]);

        }
         else
          {
          
           return response()->json([
              'status' => 0,
              'message' => 'UnAuthorized / Insufficient Input',
              'data' => $data
              ]);

          }
    }
}
