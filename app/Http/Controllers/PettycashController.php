<?php

namespace App\Http\Controllers;

use App\Models\Pettycash;
use App\Models\PettycashOverview;
use App\Models\PettyCashDetail;
use App\Models\PettycashSummary;
use App\Models\User;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class PettycashController extends Controller
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

    public function index()
    {
        $user = Auth::user();

        if($user->role == 'admin' || $user->role == 'finance'){
           
                $data = PettycashOverview::with(['details' => function ($query) {
                    $query->where('isapproved', '=', 0);
                }])->orderBy('id', 'DESC')->paginate();
               
               }

        else {
            $data = PettycashOverview::where('user_id',Auth::user()->id)
                     ->with(['details' => function ($query) {
                            $query->where('isapproved', '=', 0);
                        }])->orderBy('id', 'DESC')->paginate(10);

        
         }

         return view('pettycash/list', compact('data'));
    }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = User::get();
        return view('pettycash/create', compact('employee'));
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
        $craete = Pettycash::create([
            'user_id' => $request->user_id ,
            'finance_id' => $request->finance_id , 
            'total' => $request->amount,
            'issued_on' => $request->issued_date,
            'comments' => $request->comment,
            'remaining' => $request->amount ,
            'spend' => '0',
            'mode'=>$request->mode,
            'reference_number' => $request->refernce
        ]);

        if($craete){ 
            $pettycash= Pettycash::select('id')->where('user_id',$request->user_id)->where('finance_id',$request->finance_id)->where('total',$request->amount)->where('issued_on',$request->issued_date)->orderBy('id', 'DESC')->first();
           
            if(PettycashOverview::where('user_id', $request->user_id)->exists()){

                 $data = PettycashOverview::where('user_id', $request->user_id)->first();
                 $issued = $data->total_issued ;
                 $balance  = $data->total_balance;

                 $total_issued = intval($issued)+intval($request->amount);
                 $total_balance = intval($balance)+intval($request->amount);

                 PettycashOverview::where('user_id', $request->user_id)->update([
                    'total_issued' => $total_issued,
                    'total_balance' => $total_balance
                ]);

                
                
               PettycashSummary::create([
                    'user_id' => $request->user_id ,
                    'finance_id' => Auth::user()->id ,
                    'pettycash_id'=> $pettycash->id,
                    'amount' => $request->amount ,
                    'comment' => $request->comment ,
                    'type' => 'Credit',
                    'balance' => $total_balance ,
                    'transaction_date' => $request->issued_date,
                    'mode' => $request->mode,
                    'reference_number' => $request->refernce ]);
               }

            
            else {
                PettycashOverview::create([
                    'user_id' => $request->user_id ,
                    'total_issued' => $request->amount,
                    'total_balance' => $request->amount]);

                PettycashSummary::create([
                    'user_id' => $request->user_id ,
                    'finance_id' => Auth::user()->id ,
                    'pettycash_id'=> $pettycash->id,
                    'amount' => $request->amount ,
                    'comment' => $request->comment ,
                    'type' => 'Credit',
                    'balance' => $request->amount,
                    'transaction_date' => $request->issued_date,
                    'mode' => $request->mode,
                    'reference_number' => $request->refernce ]);
               }

            return redirect()->route('pettycash');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pettycash  $pettycash
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pettycash::where('user_id', $id)->paginate(10);

        return view('pettycash/info', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pettycash  $pettycash
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = User::get();
        $data = Pettycash::where('id', $id)->first();
        return view('pettycash/edit', compact('data' ,  'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pettycash  $pettycash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pettycash = Pettycash::where('id', $request->rowid)->first();
        
        $pre_amount = $pettycash->total;

        $update = Pettycash::where('id', $request->rowid)->update([
            'user_id' => $request->user_id ,
            'finance_id' => Auth::user()->id ,
            'total' => $request->amount,
            'issued_on' => $request->issued_date ,
            'comments' => $request->comment,
            'remaining' => $request->amount ,
            'mode'=>$request->mode,
            'reference_number' => $request->refernce
        ]);

        if($update){
           $data = PettycashOverview::where('user_id', $request->user_id)->first();
                 $issued = $data->total_issued ;
                 $balance  = $data->total_balance;
                 
                 $amount = intval($request->amount)-intval($pre_amount) ;

                //print_r($amount); die();

                 $total_issued = intval($issued)+intval($amount); 
                 $total_balance = intval($balance)+intval($amount);

                 if($request->amount > $pettycash->total){
                    $mode = 'Credit';
                    $comment = 'modified';
                    $updatedamount = intval($request->amount)-intval($pettycash->total);
                 }
                 else {
                    $mode = 'Debit';
                    $comment = 'amount reversal';
                    $updatedamount = intval($pettycash->total)-intval($request->amount);
                 }

                 PettycashOverview::where('user_id', $request->user_id)->update([
                    'total_issued' => $total_issued,
                    'total_balance' => $total_balance
                ]);

                $due = intval($request->amount)-intval($pettycash->total);
               // print_r($due);

                PettycashSummary::where('pettycash_id',$request->rowid)->where('type', 'Credit')->update([
                    'amount' => $request->amount,
                    'finance_id'=> Auth::user()->id ,
                    'transaction_date' => $request->issued_date ,
                    'comment'=> $request->comment ,
                    'mode' => $request->mode ,
                    'reference_number' => $request->refernce ]);
               
                /*if($due != 0){
                 print_r("due there");

                 

                    $summary = PettycashSummary::create([
                    'user_id' => $request->user_id ,
                    'finance_id' => Auth::user()->id ,
                    'pettycash_id'=> $request->rowid,
                    'amount' => $updatedamount ,
                    'comment' => $comment ,
                    'type' => $mode,
                    'balance' => $total_balance ,
                    'transaction_date' => $request->issued_date,
                    'mode' => $request->mode,
                    'reference_number' => $request->refernce]);

                }
                else {
                     print_r("no due");die();
                }*/

                 
               }

       // }
       
       return redirect()->route('pettycash_info',$request->user_id);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pettycash  $pettycash
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        if(PettyCashDetail::where('pettycash_id' , $id)->exists())
        {
            return redirect()->back()->withMessage('This Pettycash is already used by the employee');
        }
        else {
             $delete = Pettycash::where('id', $id)->delete();
             return redirect()->back();

        }
       
        
            
      
    }

     function action(Request $request)
    {

        $search = $request->get('search') ;
        /* $data = DB::table('users')->select("*", DB::raw("CONCAT(users.name,' - ',users.role) AS value"))
        ->where('name', 'LIKE', '%'. $request->get('search'). '%')->get();
    */
        /*$data = User::select(DB::Raw("CONCAT(name, ' - ', id) AS value"))
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();*/

                    $data = DB::table('users')
            ->select(
                    'users.name',
                    'roles.alias',
                    'users.id',
                    'employees.employee_id',
                     DB::raw("CONCAT(users.name,' - ',employees.employee_id,' - ',roles.alias) AS value") 
                    
                )
          // ->select( DB::raw("CONCAT(users.name,' - ',roles.alias) AS value") )
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->whereNull('employees.deleted_at')
            ->where(function($query)use ($search){
                    $query->where('users.name','LIKE','%'.$search.'%')->orWhere('employees.employee_id','LIKE','%'.$search.'%');
                 })
        
            ->get();
            

           // print_r($data);die();
    
        return response()->json($data);
    }

    public function summary($id){
       
        $data = PettycashSummary::where('user_id',$id)->orderBy('id', 'DESC')->first();

       // print_r(json_encode($data)); die();
        $user = Employee::where('user_id' , $id)->first();

         return view('pettycash/summary',compact('data','id', 'user') );

    }

    public function search(Request $request){
         $user = Auth::user();
         $search = $request->search ;

        $data = PettycashOverview::whereHas('employee', function ($query) use ($search) {
                $query->where('name','LIKE','%'.$search.'%')->orWhere('employee_id','LIKE','%'.$search.'%');
            })
        ->with(['details' => function ($query) {
            $query->where('isapproved', '=', 0);
        }])->orderBy('id', 'DESC')->paginate();
         
         return view('pettycash/list', compact('data'));
    }

   
}
