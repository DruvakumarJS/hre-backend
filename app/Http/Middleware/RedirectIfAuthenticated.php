<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        /*$guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }*/



    if (Auth::guard($guards)->check()) {

        $role = Auth::user()->role_id;

        echo  $role ; exit;
              switch ($role) {
                case '1':
                 // return '/home';
                  return redirect()->route('home');
                  break;

                case '2':
                  //return '/manager_home';
                   return redirect()->route('manager_home');
                  break; 

                case '3':
                 // return '/procurement_home';
                   return redirect()->route('procurement_home');
                  break; 

                 case '4':
                 // return '/home';
                  return redirect()->route('supervisor_home');
                  break;  
                    
                case '5':
                 // return '/finance_home';
                  return redirect()->route('finance_home');
                  break;        

                default:
                 // return '/login'; 
                   return redirect()->route('logout');
                break;
              }
      }
      return $next($request);
    }
}
