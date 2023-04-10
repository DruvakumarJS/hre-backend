<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User ; 
Use App\Models\Roles ; 
Use App\Models\Employee ; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins_count = Employee::where('role','admin')->count();
        $manager_count = Employee::where('role','manager')->count();
        $procurement_count = Employee::where('role','procurement')->count();
        $supervisors_count = Employee::where('role','supervisor')->count();
        $finance_count = Employee::where('role','finance')->count();


        return view('user/list', compact('admins_count' , 'manager_count' , 'procurement_count' , 'supervisors_count' , 'finance_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      $role_id = Roles::where('name',$request->role)->first();


       $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'mobile' => 'required|min:10|unique:employees',
            'email' => 'required|email|unique:employees',    
        ]);


       if ($validator->fails()) {
              return redirect()->route('create_user')
                        ->withErrors($validator)
                        ->withInput();
                     
        }
        else{

               $users = User::create([
                'name' => $request->name ,
                'email' => $request->email,
                'role_id'=> $role_id->id,
                'role' => $request->role,
                'password' =>Hash::make($request->mobile)
            ]);

               if($users){

                 $usersdetails = User::select('id')->where('email',$request->email)->first();

                   $Employees = Employee::create([
                    'user_id' => $usersdetails->id ,
                    'employee_id' => $request->employee_id , 
                    'name' => $request->name ,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'role' => $request->role,
                    'password' =>Hash::make($request->mobile),
                       ]);

                   if($request->role == 'supervisor'){
                    return redirect()->route('supervisors');

                   }
                   else if($request->role == 'admin') {
                    return redirect()->route('superadmin');

                   }
                   else if($request->role == 'manager') {
                    return redirect()->route('manager');
                   }
                   else if($request->role == 'procurement') {
                    return redirect()->route('procurement');
                   }
                   else if($request->role == 'finance') {
                    return redirect()->route('finance');
                   }


                   }
                   else {
                    return redirect()->route('users')->withMessage('Category Already Exists')->withInput();
                   }
        }   

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public  function view_superadmins(){
       $users = Employee::where('role','admin')->paginate(10);
       $role = "Super Admin";
        return view('user/users_list',compact('users' , 'role'));
    }

     public  function view_managers(){
        $users = Employee::where('role','manager')->paginate(10);
       $role = "Project Manager";
        return view('user/users_list',compact('users' , 'role'));
    }

     public  function view_supervisors(){
        $users = Employee::where('role','supervisor')->paginate(10);
        $role = "Supervisor";
        return view('user/users_list',compact('users' , 'role'));
    }

     public  function view_procurement(){
       $users = Employee::where('role','procurement')->paginate(10);
       $role = "Procurement";
        return view('user/users_list',compact('users' , 'role'));
    }

     public  function view_finance(){
       $users = Employee::where('role','finance')->paginate(10);
       $role = "Finance";
        return view('user/users_list',compact('users' , 'role'));
    }

    
    public  function create_user(){
        $roles = Roles::select('name')->get();
        return view('user/create_user',compact('roles'));
    }

    public  function create_pcn(){
        return view('pcn/create_pcn');
    }
}
