<?php

namespace App\Http\Controllers;

use App\Models\PettyCashDetail;
use App\Models\Pettycash;
use App\Models\PettycashOverview;
use App\Models\PettycashSummary;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use ZipArchive;
use File;

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
       // print_r($request->Input());die();

        $fileName='';
        $imagearray=array();
        $bill_no = 'PC00';

        $file = $request->file('image');
        $file = $request->file_name; 
  

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

          return redirect()->route('details_pettycash',Auth::user()->id);


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

                     return redirect()->back()->withMesage('Updated');
                 }

            

        }
        else if($request->status == '2'){
             $update = PettyCashDetail::where('id',$request->id)->update(['isapproved' => $request->status , 'remarks' => $request->remarks]);
            if($update){
                $Data = PettyCashDetail::where('id',$request->id)->first();
                $PettyCash = Pettycash::where('id',$Data->pettycash_id)->first();


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
          echo json_encode($data);
        
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

        $data = $request->Input();
        return response()->json($data);

    }
}
