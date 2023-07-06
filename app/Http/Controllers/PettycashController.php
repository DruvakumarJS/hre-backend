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
           /* $data = Pettycash::with(['details' => function ($query) {
                    $query->where('isapproved', '=', 0);
                }])->orderBy('id', 'DESC')->paginate();*/
/*
               $data= array();
               $pettycash = Pettycash::select('user_id')->groupBy('user_id')->orderBy('user_id', 'ASC')->get();

               foreach ($pettycash as $key => $value) {
                  $user = Employee::where('user_id',$value->user_id)->first();
                  $issued = Pettycash::select('total')->where('user_id',$value->user_id)->get();
                  $issued_amount = $issued->sum('total');

                  $balance = Pettycash::select('remaining')->where('user_id',$value->user_id)->get();
                  $balance_amount = $balance->sum('remaining');

                 

                  $data[] = [
                    'user_id' => $user->user_id,
                    'employee_id' => $user->employee_id,
                    'name' => $user->name,
                    'role' => $user->user->roles->alias,
                    'issued' => $issued_amount ,
                    'balance' => $balance_amount];
*/
                $data = PettycashOverview::with(['details' => function ($query) {
                    $query->where('isapproved', '=', 0);
                }])->orderBy('id', 'DESC')->paginate();
                    
                //$data = PettycashOverview::orderBy('id', 'DESC')->paginate();   

               }

              // print(json_encode($data)); die();
        
        else {
            /*$data= array();
               
                  $user = Employee::where('user_id',Auth::user()->id)->first();
                  $issued = Pettycash::select('total')->where('user_id',Auth::user()->id)->get();
                  $issued_amount = $issued->sum('total');

                  $balance = Pettycash::select('remaining')->where('user_id',Auth::user()->id)->get();
                  $balance_amount = $balance->sum('remaining');

                 

                  $data[] = [
                    'user_id' => $user->user_id,
                    'employee_id' => $user->employee_id,
                    'name' => $user->name,
                    'role' => $user->user->roles->alias,
                    'issued' => $issued_amount ,
                    'balance' => $balance_amount];


               }*/
               $data = PettycashOverview::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->paginate();   
        
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
                    'amount' => $request->amount ,
                    'comment' => $request->comment ,
                    'type' => 'Credit',
                    'balance' => $total_balance ]);
               }

            
            else {
                PettycashOverview::create([
                    'user_id' => $request->user_id ,
                    'total_issued' => $request->amount,
                    'total_balance' => $request->amount]);

                PettycashSummary::create([
                    'user_id' => $request->user_id ,
                    'amount' => $request->amount ,
                    'comment' => $request->comment ,
                    'type' => 'Credit',
                    'balance' => $request->amount ]);
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
            'total' => $request->amount,
            'issued_on' => $request->issued_date ,
            'comments' => $request->comment,
            'remaining' => $request->amount ,
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

                 PettycashSummary::create([
                    'user_id' => $request->user_id ,
                    'amount' => $updatedamount ,
                    'comment' => $comment ,
                    'type' => $mode,
                    'balance' => $total_balance ]);
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
            ->where('users.name', 'LIKE', '%'. $request->get('search'). '%')
            ->orWhere('employees.employee_id', 'LIKE', '%'. $request->get('search'). '%')->get();
            

           // print_r($data);die();
    
        return response()->json($data);
    }

    public function summary($id){
       
        $data = PettycashSummary::where('user_id',$id)->get();

         return view('pettycash/summary',compact('data','id') );

    }

   
}
