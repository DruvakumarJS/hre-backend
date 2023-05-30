<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;
//use Auth ;

class Role {

  public function handle($request, Closure $next, String $role) {
   // echo 'Role';
   // echo $role ; die();
    $user = Auth::user();
   // echo $user ; die();

    if($user->role == $role)
    {
      return $next($request);
    }
  
   if($user->role_id == '1'){
    return redirect('/home');
   }
       
   if($user->role_id == '5'){
     return redirect('/home');
   }
   
  
  if($user->role_id == '2'){
     return redirect('/manager_home');
  }
     
   if($user->role_id == '3'){
      return redirect('/procurement_home');
   }

    if($user->role_id == '4'){
      return redirect('/supervisor_home');
    }

   /* if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
      return redirect('/home');

    $user = Auth::user();*/

   /* $user = Auth::user();
    echo $user ; die();*/

    /*if($user->role == $role)
    {
      return $next($request);
    }
  
   if($user->role_id == '1')
   	return redirect('/home');
      //return $next($request);
   if($user->role_id == '5')
    return redirect('/finance_home');
  
  if($user->role_id == '2')
      return redirect('/manager_home');

   if($user->role_id == '3')
      return redirect('/procurement_home');

    if($user->role_id == '4')
      return redirect('/supervisor_home');
  
*/

    //return redirect('/home');
  }
}