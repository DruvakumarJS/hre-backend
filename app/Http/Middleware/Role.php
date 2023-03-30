<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;

class Role {

  public function handle($request, Closure $next, String $role) {
    if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
      return redirect('/home');

    $user = Auth::user();
    if($user->role == $role)
    {
      return $next($request);
    }



   if($user->role_id == '1')
   	return redirect('/home');
      //return $next($request);

  if($user->role_id == '2')
      return redirect('/manager_home');

   if($user->role_id == '3')
      return redirect('/procurement_home');
  


    //return redirect('/home');
  }
}