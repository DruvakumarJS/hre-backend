<?php

namespace App\Http\Controllers;

use App\Models\PettyCashDetail;
use App\Models\Pettycash;
use App\Models\PettycashOverview;
use App\Models\PettycashSummary;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Mail\PettycashMail;
use Auth;
use ZipArchive;
use File;
use Mail;

class PettyCashDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
         $data = PettyCashDetail::where('user_id' , $id)->orderBy('id', 'DESC')->get();
         $myspent = PettyCashDetail::where('user_id' , $id)->where('isapproved','!=' , '2')->sum('spent_amount');
         $pettycash = PettycashOverview::where('user_id', $id)->first();

         //print_r($myspent);die();

        return view('pettycash/details',compact('data' , 'pettycash' , 'myspent' , 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('pettycash/add_expenses');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  print_r($request->Input());die();

        $fileName='';
        $imagearray=array();
        $bill_no = 'PC00';

        $file = $request->file('file');
        $file = $request->file_name; 
  

         if($file = $request->has('file')) {
           
         
            foreach($_FILES['file']['name'] as $key=>$val){
             
               
               $fileName = basename($_FILES['file']['name'][$key]); 
                $temp = explode(".", $fileName);
                 
                $fileName = rand('111111','999999') . '.' . end($temp);

            $destinationPath = public_path().'/pettycashfiles/'.$fileName ;
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);

            $imagearray[] = $fileName ;
                  
            }
          
          }
         // print_r($imagearray);
     
     
           $imageNames = implode(',', $imagearray);
           if(PettyCashDetail::exists()){
                 $conversation_id = PettyCashDetail::select('id')->orderBy('id', 'DESC')->first();                 
                 $bill_no= "PC00".++$conversation_id->id;
            }
            else{                 
                 $bill_no= 'PC001';                
            }

          $createData = PettyCashDetail::create([
                'user_id' => Auth::user()->id,
                'billing_no' => $bill_no ,
                'bill_date' => $request->bill_date ,
                'bill_number' => $request->bill_number ,
                'spent_amount' => $request->amount ,
                'purpose' => $request->purpose ,
                'pcn' => $request->pcn,
                'comments' => $request->comment,
                'filename' => $imageNames,
                'isapproved' => '0'
            ]);

          $finance = pettycash::select('finance_id')->where('id', $request->id)->first();

         /* $userdetail = Employee::where('user_id',Auth::user()->id)->first();

          $message = "Your Pettycash Bill of amount Rs.".$request->amount. " dated ".$request->bill_date. " has been submitted successfully . You can check the status of the bill on your Dashboard. https://hre.netiapps.com/pettycash_details/".Auth::user()->id;

          $p_data= ['name'=> $userdetail->name , 'message' => $message];*/

          //Mail::to($userdetail->email)->send(new PettycashMail($message));
          //Mail::to('druva@netiapps.com')->send(new PettycashMail($p_data));

         // return redirect()->route('details_pettycash',Auth::user()->id);
          $id="Success";
         
           return response()->json($id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PettyCashDetail  $pettyCashDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PettyCashDetail $pettyCashDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PettyCashDetail  $pettyCashDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PettyCashDetail  $pettyCashDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      //  print_r($request->Input());die();

        if($request->status == '1'){
            $update = PettyCashDetail::where('id',$request->id)->update(['isapproved' => $request->status , 'remarks' => $request->remarks]);
            if($update){
                $Data = PettyCashDetail::where('id',$request->id)->first();

                $PettyCash = PettycashOverview::where('user_id',$Data->user_id)->first();
                 //$total_issued = $PettyCash->total_issued;
                 $total_balance = $PettyCash->total_balance;

                // $total_spend = intval($spend)+intval($Data->spent_amount);
                $outstanding = intval($total_balance)-intval($Data->spent_amount);

                $updatetable = PettycashOverview::where('user_id',$Data->user_id)->update(['total_balance'=>$outstanding]);

                $summary = PettycashSummary::create([
                    'user_id' => $Data->user_id ,
                    'finance_id' => Auth::user()->id,
                    'pettycash_id'=> $Data->id,
                    'amount' => $Data->spent_amount ,
                    'comment' => $Data->comments ,
                    'type' => 'Debit',
                    'balance' => $outstanding,
                    'transaction_date' => $Data->bill_date,
                    'reference_number'=>$Data->bill_number
                      ]);
               }

                 if($updatetable){

          $finance = pettycash::select('finance_id')->where('id', $request->id)->first();

          $userdetail = Employee::where('user_id',Auth::user()->id)->first();

          $message = "Your Pettycash Bill of amount Rs.".$Data->spent_amount." dated " .$Data->bill_date ." has been Approved . You can check on your Dashboard. https://hre.netiapps.com/pettycash_details/".Auth::user()->id;

          $p_data= ['name'=> $userdetail->name ,'message' => $message];

          //Mail::to($userdetail->email)->send(new PettycashMail($message));
          //Mail::to('druva@netiapps.com')->send(new PettycashMail($p_data));

                     return redirect()->back()->withMesage('Updated');
                 }

            

        }
        else if($request->status == '2'){
             $update = PettyCashDetail::where('id',$request->id)->update(['isapproved' => $request->status , 'remarks' => $request->remarks]);
            if($update){
                $Data = PettyCashDetail::where('id',$request->id)->first();
                $PettyCash = Pettycash::where('id',$Data->pettycash_id)->first();

                $finance = pettycash::select('finance_id')->where('id', $request->id)->first();

                  $userdetail = Employee::where('user_id',Auth::user()->id)->first();

                  $message = "Your Pettycash Bill of amount Rs.".$Data->spent_amount." dated " .$Data->bill_date." has been Rejected due to ".$request->remarks. " .You can check on your Dashboard. https://hre.netiapps.com/pettycash_details/".Auth::user()->id;

                  $p_data= ['name'=> $userdetail->name , 'message' => $message];

                  //Mail::to($userdetail->email)->send(new PettycashMail($message));
                 // Mail::to('druva@netiapps.com')->send(new PettycashMail($p_data));


                 return redirect()->back()->withMesage('Updated');
            }
       

        }
        else{
            return redirect()->back()->withMesage('Something went wrong...');
        }
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PettyCashDetail  $pettyCashDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data = pettyCashDetail::select('isapproved')->where('id',$id)->first(); 
       if($data->isapproved == '0'){
         $delete = PettyCashDetail::where('id', $id)->delete();
       }
          return redirect()->back();

     
    }

    public function fetch_summary(Request $request){

       $data = array();
       if($request->from_date != '' && $request->to_date != '')
        {
            $data = array();
            $now = strtotime($request->from_date);
            $last = strtotime($request->to_date);

           $open_credits = PettycashSummary::where('user_id',$request->id)->where('transaction_date' ,'<' , date('Y-m-d', $now))->where('type','Credit')->sum('amount');
           $open_debits = PettycashSummary::where('user_id',$request->id)->where('transaction_date' ,'<' , date('Y-m-d', $now))->where('type','Debit')->sum('amount');
           $open_balance = intval($open_credits)-intval($open_debits);
           
          // print_r($open_credits ."".$open_debits."=".$open_balance);print_r("<br>"); 
           $close_credits = PettycashSummary::where('user_id',$request->id)->where('transaction_date' ,'<=' , date('Y-m-d', $last))->where('type','Credit')->sum('amount');
           $close_debits = PettycashSummary::where('user_id',$request->id)->where('transaction_date' ,'<=' , date('Y-m-d', $last))->where('type','Debit')->sum('amount');
           $close_balance = intval($close_credits)-intval($close_debits); 

          // print_r($close_credits ."".$close_debits."=".$close_balance); die();  

           while($now <= $last ) {

           /* $summary = PettycashSummary::where('user_id',$request->id)->where('created_at','LIKE',date('Y-m-d', $now).'%')->get();
*/
           $summary = PettycashSummary::where('user_id',$request->id)->where('transaction_date',date('Y-m-d', $now))->orderBy('id','ASC')->get();

            foreach ($summary as $key => $value) {
                $reference = $value->reference_number;
                $mode = $value->mode;

                if($reference == '' ){
                   $reference = '';
                }

                if($mode == '' ){
                   $mode = '';
                }

                $finance = User::select('name')->where('id',$value->finance_id)->first();

                $data[]=[
                    'date' => \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y'),
                    'finance_id' => $finance->name, 
                    'amount' => $value->amount,
                    'comment' => $value->comment,
                    'issued_date' => \Carbon\Carbon::createFromFormat('Y-m-d', $value->transaction_date)->format('d-m-Y') ,
                    'type' => $value->type,
                    'balance' => $value->balance,
                    'mode' => $mode,
                    'created_at' =>\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y-H:i'),
                    'ref' => $reference
                ];
              
            
         }

          $now = strtotime('+1 day', $now);
         } 

        }
         else
          {
           $data = 'mnm';
          }

          $detail = ['opening' => $open_balance , 'closing'=> $close_balance , 'summary' => $data];

          echo json_encode($detail);
        
    }

    public function download_bills($id){


      

        $data = pettyCashDetail::select('filename')->where('id', $id)->first();

        $zip = new \ZipArchive();
        $fileName = 'zipFile.zip';
        $destinationPath = public_path($fileName);

        if(file_exists($destinationPath)){
           
            unlink($destinationPath);
        }

         

       //  die();


        $downloads = explode(',', $data->filename);

        if ($zip->open(public_path($fileName), \ZipArchive::CREATE)== TRUE)
        {
           //$files = File::files(public_path('myFiles'));
            foreach ($downloads as $key => $value){
                $relativeName = basename($value);
                $path = 'pettycashfiles/'.$relativeName;
                $zip->addFile($path);
            }
            $zip->close();
        }

        return response()->download(public_path($fileName));

        /*foreach ($downloads as $key => $value) {
           
            $path = 'pettycashfiles/'.$value;
           return response()->download(public_path($path));     
        }*/

        //die();

        /*$destinationPath = public_path($fileName);
        unlink("test.txt");*/

      //  return redirect()->back();

    }


    public function test(Request $request){

     //  $imagearray = implode(',', $request->image);
       
        $data = $request->Input();

        /* if($request->file('file')) {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();

             $destinationPath = public_path().'/pettycashfiles/'.$filename ;
            //move($destinationPath,$fileName);
            move_uploaded_file($_FILES["file"]["tmp_name"], $destinationPath);

            return response()->json($filename);
        }*/
       // return response()->json($data);

       if($file = $request->has('file')) {
       
          foreach($_FILES['file']['name'] as $key=>$val){
             
             $fileName = basename($_FILES['file']['name'][$key]);
             $temp = explode(".", $fileName);
              $fileName = rand('111111','999999') . '.' . end($temp);
              $destinationPath = public_path().'/test/'.$fileName ; 
               move_uploaded_file($_FILES["file"]["tmp_name"][$key], $destinationPath);
                $imagearray[] = $fileName ;
                 $data[]=$fileName;
         }

       }
       else {
        $data= "NO";
       }
     return response()->json($request->Input());


        /* if($file = $request->has('file')) {
                   
                 
                    foreach($_FILES['file']['name'] as $key=>$val){
                     
                       
                       $fileName = basename($_FILES['file']['name'][$key]); 
                        $temp = explode(".", $fileName);
                         
                        $fileName = rand('111111','999999') . '.' . end($temp);

                   // $destinationPath = public_path().'/pettycashfiles/'.$fileName ;
                    //move($destinationPath,$fileName);
                   // move_uploaded_file($_FILES["files"]["tmp_name"][$key], $destinationPath);

                    $imagearray[] = $fileName ;
                     
                         
                    }
                  
                  }
                


        return response()->json($imagearray);*/

     
    
    }

    public function reminder($id){
      $empl = Employee::where('user_id', $id)->first();
      $p_data = "PettyCash bill approval request : ".$empl->employee_id;

       $emailarray = User::select('email')->where('role_id','5')->orWhere('role_id','1')->get();

               foreach ($emailarray as $key => $value) {
                  $emailid[]=$value->email;
               }

      
      try {
              Mail::to($emailid)->send(new PettycashMail($p_data , $id));
            } catch (\Exception $e) {
                return $e->getMessage();
               
            } 
            finally {
             
              return redirect()->back();
            }     
     
    }

    public function search_bill(Request $request){
     // print_r($request->Input()); die();

      $search = $request->search ;
      $id = $request->user_id;

      if($search == ''){
       // print_r('lll'); die();
        return redirect()->route('details_pettycash',$id);
      }
      else{
         $data = PettyCashDetail::where( function ($query) use ($search){
                   $query->where('bill_number' ,'LIKE', $search.'%');
                   $query->orWhere('spent_amount' ,'LIKE', $search.'%');
                   $query->orWhere('purpose' , 'LIKE', $search.'%');
                   $query->orWhere('pcn' , 'LIKE', $search.'%');
                   $query->orWhere('comments' ,'LIKE', $search.'%');
                   $query->orWhere('remarks' ,'LIKE', $search.'%');
                   $query->orWhere('isapproved' , 'LIKE', $search.'%');
                   $query->orWhere('bill_date' , 'LIKE', $search.'%');

                })
                ->where('user_id' , $id)
                ->orderBy('id', 'DESC')
                ->get();

         $myspent = PettyCashDetail::where('user_id' , $id)->where('isapproved','!=' , '2')->sum('spent_amount');
         $pettycash = PettycashOverview::where('user_id', $id)->first();

         //print_r($data);die();

        return view('pettycash/details',compact('data' , 'pettycash' , 'myspent' , 'id'));
      }


    }

    public function revert_bill_status(Request $request){
    // print_r($request->Input()); die();

     if($request->status == '1'){
            $update = PettyCashDetail::where('id',$request->id)->update(['isapproved' => $request->status , 'remarks' => $request->remarks." (Reverted : ".$request->reason.")"]);
            if($update){
                $Data = PettyCashDetail::where('id',$request->id)->first();

                $PettyCash = PettycashOverview::where('user_id',$Data->user_id)->first();
                 //$total_issued = $PettyCash->total_issued;
                 $total_balance = $PettyCash->total_balance;

                // $total_spend = intval($spend)+intval($Data->spent_amount);
                $outstanding = intval($total_balance)-intval($Data->spent_amount);

                $updatetable = PettycashOverview::where('user_id',$Data->user_id)->update(['total_balance'=>$outstanding]);

                $summary = PettycashSummary::create([
                    'user_id' => $Data->user_id ,
                    'finance_id' => Auth::user()->id,
                    'pettycash_id'=> $Data->id,
                    'amount' => $Data->spent_amount ,
                    'comment' => "Reverted : ".$request->reason ,
                    'type' => 'Debit',
                    'balance' => $outstanding,
                    'transaction_date' => $Data->bill_date,
                    'reference_number'=>$Data->bill_number
                      ]);
               }

                 if($updatetable){

                    // return redirect()->back()->withMesage('Updated');
                     return redirect()->route('details_pettycash',$Data->user_id)->withMesage('Updated');
                 }

            

        }
        else if($request->status == '2'){
             $update = PettyCashDetail::where('id',$request->id)->update(['isapproved' => $request->status , 'remarks' => $request->remarks." (Reverted : ".$request->reason.")"]);
            if($update){
                $Data = PettyCashDetail::where('id',$request->id)->first();

                $PettyCash = PettycashOverview::where('user_id',$Data->user_id)->first();
                 //$total_issued = $PettyCash->total_issued;
                 $total_balance = $PettyCash->total_balance;

                // $total_spend = intval($spend)+intval($Data->spent_amount);
                $outstanding = intval($total_balance)+intval($Data->spent_amount);

                $updatetable = PettycashOverview::where('user_id',$Data->user_id)->update(['total_balance'=>$outstanding]);

                $summary = PettycashSummary::create([
                    'user_id' => $Data->user_id ,
                    'finance_id' => Auth::user()->id,
                    'pettycash_id'=> $Data->id,
                    'amount' => $Data->spent_amount ,
                    'comment' => "Reverted : ".$request->reason ,
                    'type' => 'Credit',
                    'balance' => $outstanding,
                    'transaction_date' => $Data->bill_date,
                    'reference_number'=>$Data->bill_number
                      ]);


                // return redirect()->back()->withMesage('Updated');
                  return redirect()->route('details_pettycash',$Data->user_id)->withMesage('Updated');
            }
       

        }
        else{
            return redirect()->back()->withMesage('Something went wrong...');
        }
        


    }


}