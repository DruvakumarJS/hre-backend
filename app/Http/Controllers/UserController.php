<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User ; 
Use App\Models\Roles ; 
Use App\Models\Employee ; 
Use App\Models\Pettycash ; 
Use App\Models\Attendance ; 
Use App\Models\Team ;
Use App\Models\FootPrint ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use App\Exports\ExportUsers;
use Excel;
use Auth;

class UserController extends Controller
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
     
     // print_r($request->Input());die();

    
       $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'employee_id' => 'required|unique:employees',
            'mobile' => 'required|min:10|max:10|unique:employees',
            'email' => 'required|email|unique:employees',    
        ]);


       if ($validator->fails()) {
              return redirect()->route('create_user',$request->role_id)
                        ->withErrors($validator)
                        ->withInput();
                     
        }
        else{

            $role = Roles::where('id',$request->role_id)->first();

            $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',    
            ]);

            if ($validator->fails()) {
              return redirect()->route('create_user',$request->role)
                        ->withErrors($validator)
                        ->withInput();
                     
              }
              else{

                if($request->password == $request->confirm_password){

                    $users = User::create([
                'name' => $request->name ,
                'email' => $request->email,
                'role_id'=> $request->role_id,
                'role' => $role->name,
                'password' =>Hash::make($request->password)
            ]);

               if($users){

                 $usersdetails = User::select('id')->where('email',$request->email)->first();

                   $Employees = Employee::create([
                    'user_id' => $usersdetails->id ,
                    'employee_id' => $request->employee_id , 
                    'name' => $request->name ,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'role' => $role->name,
                    'role_id'=> $request->role_id
    
                       ]);

                 $footprint = FootPrint::create([
                    'action' => 'New user created - '.$request->employee_id,
                    'user_id' => Auth::user()->id,
                    'module' => 'User',
                    'operation' => 'C'
                ]);

                   if($request->role == 'supervisor'){
                    return redirect()->route('supervisor');

                   }
                   else if($request->role == 'admin') {
                    return redirect()->route('admin');

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
                   else{
                    return redirect()->route('view_users',$role->id);
                   }


                   }
                   else {
                    return redirect()->route('users')->withMessage('Something went wrong')->withInput();
                   }


                }
                else {
                     return redirect()->route('create_user',$request->role_id)
                        ->withMessage("Password and Confirm Password do not match")
                        ->withInput();
                }



               
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
        $userData = Employee::where('user_id',$id)->first();

        $role = Roles::where('id', $userData->role_id)->first();

       // $roles = Roles::where('team_id', $role->team_id)->get();
         $roles = Roles::get();
        return view('user/edit', compact('userData' , 'id' , 'roles'));
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
       // print_r($id); die();

       /* if(Employee::where('mobile',$request->mobile)->where('user_id' ,'!=', $id)->exists()){
            print_r("YES");
        }
        else {
            print_r("NO");
        }
        die();*/

         $validator = Validator::make($request->all(), [
            'employee_id' => 'required|unique:employees,employee_id,'.$request->row_id,
            'mobile' => 'required|min:10|max:10|unique:employees,mobile,'.$request->row_id,
            'email' => 'required|email|unique:employees,email,'.$request->row_id,    
        ]);



       if ($validator->fails()) {
              return redirect()->back()
                         ->withErrors($validator)
                        ->withInput();   

                     
        }
        else{

    
           if($request->password!=''){
                 if($request->password == $request->confirm_password ){
                    $updateuser = User::where('id',$request->user_id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password'=> Hash::make($request->password)]);
                 }
                else {
                     return redirect()->back()
                        ->withMessage("Password and Confirm Password do not match")
                        ->withInput();
          }

           }
           else {

            $updateuser = User::where('id',$request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'status' => $request->status]);
           }
            

            if($updateuser){

                $UpdateEmployees = Employee::where('id', $request->row_id)->update([
                    'employee_id' => $request->employee_id , 
                    'name' => $request->name ,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'status' => $request->status,
    
                       ]);

              if($UpdateEmployees){

                 $footprint = FootPrint::create([
                    'action' => 'user details modified - '.$request->employee_id,
                    'user_id' => Auth::user()->id,
                    'module' => 'User',
                    'operation' => 'U'
                ]);

                $role = Employee::where('user_id',$request->user_id)->first();

                return redirect()->route('view_users',$role->role_id);
              }
              else {
                return redirect()->back()
                        ->withMessage("Error while updating data..")
                        ->withInput();
              }
                
            }
            else {
                 return redirect()->back()
                        ->withMessage("Error while updating user data..")
                        ->withInput();
            }
        }
       

    


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if(Pettycash::where('user_id', $id)->where('remaining','!=' ,'0')->exists()){
             return redirect()->back()->withMessage('User has unspent Pettycash. so,Cannot delete the user ');
        }
        else {

            $destroy = User::where('id',$id)->delete();


        if($destroy){
          // print_r("kkk");die();
            $emp = Employee::where('user_id',$id)->first();
            $employee_id = $emp->employee_id;

           
            $deleteEmpl = Employee::where('user_id',$id)->delete();
            if($deleteEmpl){


                $footprint = FootPrint::create([
                    'action' => 'User deleted - '.$employee_id,
                    'user_id' => Auth::user()->id,
                    'module' => 'User',
                    'operation' => 'D'
                ]);

                return redirect()->back();
            }
         
        }

        }
        

        /*if($delete){
            $delete = Employee::where('user_id',$id)->delete();
            return redirect()->back();
        }*/
    }

    public function force_logout($id){
        //print_r("ll"); die();
          
          $update = User::where('id',$id)->update(['isloggedin' => '0']);

          if($update && Attendance::where('user_id' , $id)->exists() ){
            $login = Attendance::where('user_id' , $id)->orderBy('id' ,'DESC')->first();

            if($login->logout_time == ''){
                $l_in = $login->date." ".$login->login_time;

                $l_out = date('Y-m-d')." ".date('H:i');

                $logintime = strtotime($l_in) ;
                $logouttime = strtotime($l_out);

                $total_hour = $logouttime - $logintime ; 

                $LOGOUT = Attendance::where('id',$login->id)->update([
                            'logout_time' => date('H:i') ,
                            'logout_lat' => '0.0' ,
                            'logout_long' => '0.0' ,
                            'logout_location' => 'No address',
                            'total_hours' => $total_hour/60,
                            'logout_date' => date('Y-m-d')
                          ]);
                if($LOGOUT){

                    $employee = Employee::where('user_id',$id)->first();
                    $footprint = FootPrint::create([
                        'action' => $employee->employee_id.'- Force Logout',
                        'user_id' => Auth::user()->id,
                        'module' => 'User',
                        'operation' => 'U'
                    ]);
                    return redirect()->back();
                }
            }
            else {
                $employee = Employee::where('user_id',$id)->first();
                    $footprint = FootPrint::create([
                        'action' => 'Force Logout - '.$employee->employee_id,
                        'user_id' => Auth::user()->id,
                        'module' => 'User',
                        'operation' => 'U'
                    ]);
                    
                 return redirect()->back();
            }

            
            
          }
          else{
             $employee = Employee::where('user_id',$id)->first();
                    $footprint = FootPrint::create([
                        'action' => 'Force Logout - '.$employee->employee_id,
                        'user_id' => Auth::user()->id,
                        'module' => 'User',
                        'operation' => 'U'
                    ]);
            return redirect()->back();
          }

    }

    public  function view_superadmins(){
       $users = Employee::where('role','admin')->paginate(25);
       $role = "Super Admin";
       $role_name = 'admin';
        return view('user/users_list',compact('users' , 'role' ,'role_name'));
    }

     public  function view_managers(){
        $users = Employee::where('role','manager')->paginate(25);
       $role = "Project Manager";
       $role_name = 'manager';
        return view('user/users_list',compact('users' , 'role','role_name'));
    }

     public  function view_supervisors(){
        $users = Employee::where('role','supervisor')->paginate(25);
        $role = "Supervisor";
        $role_name = 'supervisor';
        return view('user/users_list',compact('users' , 'role','role_name'));
    }

     public  function view_procurement(){
       $users = Employee::where('role','procurement')->paginate(25);
       $role = "Procurement";
        $role_name = 'procurement';
        return view('user/users_list',compact('users' , 'role','role_name'));
    }

     public  function view_finance(){
       $users = Employee::where('role','finance')->paginate(25);
       $role = "Finance";
       $role_name = 'finance';
        return view('user/users_list',compact('users' , 'role','role_name'));
    }

    
    public  function create_user($role_id){
       // print_r($role_id); die();
        $role = Roles::where('id',$role_id)->first();
        $rolename = $role->alias ; 
        return view('user/create_user',compact('role_id' , 'rolename'));
    }

    public  function create_pcn(){
        return view('pcn/create_pcn');
    }

    

    public function back(){
        return redirect()->back();
    }

    public function roles(){
        $admins_count = User::where('role_id','1')->count();
        $manager_count = User::where('role_id','2')->count();
        $procurement_count = User::where('role_id','3')->count();
        $supervisors_count = User::where('role_id','4')->count();
        $finance_count = User::where('role_id','5')->count();

        $admins = User::where('role_id','6')->count();
        $exec_manager_count = User::where('role_id','7')->count();
        $exec_procurement_count = User::where('role_id','8')->count();
        $trianee_supervisors_count = User::where('role_id','9')->count();
        $accounts_count = User::where('role_id','10')->count();
       
        $assi_manager_count = User::where('role_id','11')->count();
        $assi_procurement_count = User::where('role_id','12')->count();
        $accountant_count = User::where('role_id','13')->count();

        $hr_count = User::where('role_id','14')->count();
        $exec_hr_count = User::where('role_id','15')->count();

        $counts = ['r1'=>$admins_count , 'r2'=>$manager_count , 'r3'=>$procurement_count ,'r4'=>$supervisors_count ,'r5'=>$finance_count ,'r6'=>$admins , 'r7'=>$exec_manager_count , 'r8'=>$exec_procurement_count ,'r9'=>$trianee_supervisors_count ,'r10'=>$accounts_count , 'r11'=>$assi_manager_count , 'r12'=>$assi_procurement_count , 'r13'=>$accountant_count ,'r14'=>$hr_count ,'r15'=>$exec_hr_count  ];

        return view('user/roles',compact('counts'));
    }

    public function view_users($role_id){
      // print_r($role_id); die();
       $roles = Roles::where('id', $role_id)->first();
       $role_name = $roles->name;
       $alias = $roles->alias ;

       $data = Employee::where('role_id',$role_id)->paginate(20);

       return view('user/users',compact('data' , 'role_name' , 'alias' , 'role_id')); 
    }

    public function promote(Request $request){
       // print_r($request->Input()); die();


        $user_id = $request->user_id;
        $newrole = $request->newrole ;

        $role = Roles::where('id',$newrole)->first();

        $update = User::where('id',$user_id)->update(['role_id'=>$newrole, 'role' => $role->name]);

        if($update){
            $promote = Employee::where('user_id',$user_id)->update(['role_id'=>$newrole, 'role' => $role->name]);

            if($promote){
                $employee = Employee::where('user_id',$user_id)->first();
                $footprint = FootPrint::create([
                    'action' => $employee->employee_id. ' prompoted as '.$role->alias,
                    'user_id' => Auth::user()->id,
                    'module' => 'User',
                    'operation' => 'U'
                ]);
                return redirect()->route('view_users',$newrole);
            }
        }

    }

    public function teams(){
      
      $teams = Team::all();
      $data = array();
     // $data = Team::with('roles')->get();
    // return view('user/teams',compact('data'));
      //print_r(json_encode($data)); die();

     foreach($teams as $key=>$value)
     {
        $name=$value->team;
       // $count= Employee::where('role_id', $value->id)->count();

        $role = Roles::where('team_id', $value->id)->get();
        $roles = array();

        foreach ($role as $key2 => $value2) {
            $count = Employee::where('role_id', $value2->id)->count();
            $roles[] = [ 'id'=>$value2->id ,'name' => $value2->name , 'alias'=> $value2->alias , 'count'=> $count];
        }

        $data[]=['name' => $name , 'roles'=>$roles];

        //array_push($data, $teamarray);
     }

    // print_r(json_encode($teamarray));die();
     return view('user/teams',compact('data'));
    }
}
