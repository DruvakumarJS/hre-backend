<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;
//use Auth ;

class Role {

  public function handle($request, Closure $next, String $role) {
   
    $user = Auth::user();

   /* echo $user->role;
    echo $user->role_id ;
    echo $user ; die();*/

    /*if($user->role == $role)
    {
      return $next($request);
    }
    else {*/
      if($user->role_id == '1'){
       // echo 'admin';
      return redirect()->route('home');
     }
     else if($user->role_id == '2'){
       //echo 'manager';
        return redirect()->route('manager_home');
     }
     else if($user->role_id == '3'){
      // echo 'procure';
       return redirect()->route('procurement_home');
     }
     else if($user->role_id == '4'){
      // echo 'supervisor';
       return redirect()->route('supervisor_home');
     }
     else if($user->role_id == '5'){
      // echo 'finance';
       return redirect()->route('finance_home');
     }
     else {
      return redirect()->route('logout');
     }
    }
 
    
  //}
}