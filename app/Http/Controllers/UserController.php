<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User ; 
Use App\Models\Roles ; 
Use App\Models\Employee ; 
Use App\Models\Pettycash ; 
Use App\Models\Attendance ; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use App\Exports\ExportUsers;
use Excel;

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
              return redirect()->route('create_user',$request->role)
                        ->withErrors($validator)
                        ->withInput();
                     
        }
        else{

            $role_id = Roles::where('name',$request->role)->first();

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
                'role_id'=> $role_id->id,
                'role' => $request->role,
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
                    'role' => $request->role,
    
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


                   }
                   else {
                    return redirect()->route('users')->withMessage('Something went wrong')->withInput();
                   }


                }
                else {
                     return redirect()->route('create_user',$request->role)
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
        return view('user/edit', compact('userData' , 'id'));
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
                'email' => $request->email]);
           }
            

            if($updateuser){

                $UpdateEmployees = Employee::where('id', $request->row_id)->update([
                    'employee_id' => $request->employee_id , 
                    'name' => $request->name ,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
    
                       ]);

              if($UpdateEmployees){
                return redirect()->route($request->role);
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
            $destroy = User::find($id)->delete();

        if($destroy){
            $deleteEmpl = Employee::where('user_id',$id)->delete();
            if($deleteEmpl){
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
          
          $update = User::where('id',$id)->update(['isloggedin' => '0']);

          if($update){
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
                    return redirect()->back();
                }
            }
            else {
                 return redirect()->back();
            }

            
            
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

    
    public  function create_user($role){
        $roles = Roles::select('*')->where('name',$role)->first();
        return view('user/create_user',compact('roles', 'role'));
    }

    public  function create_pcn(){
        return view('pcn/create_pcn');
    }

    

    public function back(){
        return redirect()->back();
    }
}
