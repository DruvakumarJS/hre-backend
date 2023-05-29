<?php

namespace App\Http\Controllers;

use App\Models\Pettycash;
use App\Models\User;
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
    public function index()
    {
        $user = Auth::user();

        if($user->role == 'admin' || $user->role == 'finance'){
            $data = Pettycash::orderBy('id', 'DESC')->paginate(10);
        }
        else {
            $data = Pettycash::where('user_id', $user->id )->orderBy('id', 'DESC')->paginate(10);
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
            'comments' => $request->comment,
            'remaining' => $request->amount ,
            'spend' => '0'
        ]);

        if($craete){
            return redirect()->route('pettycash');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pettycash  $pettycash
     * @return \Illuminate\Http\Response
     */
    public function show(Pettycash $pettycash)
    {
        //
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
        $update = Pettycash::where('id', $request->rowid)->update([
            'user_id' => $request->user_id ,
            'total' => $request->amount,
            'comments' => $request->comment,
            'remaining' => $request->amount ,
        ]);
       
       return redirect()->route('pettycash');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pettycash  $pettycash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pettycash $pettycash)
    {
        //
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
                     DB::raw("CONCAT(users.name,' - ',roles.alias) AS value") 
                    
                )
          // ->select( DB::raw("CONCAT(users.name,' - ',roles.alias) AS value") )
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.name', 'LIKE', '%'. $request->get('search'). '%')->get();
            

           // print_r($data);die();
    
        return response()->json($data);
    }
}
