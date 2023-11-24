<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo() 
    {
          $role = Auth::user()->role_id; 
          switch ($role) {
            case '1':
               return '/home';
              break;
            case '2':
               return '/manager_home';
              break;

            case '3':
              return '/procurement_home';
              break;

            case '4':
              return '/supervisor_home';
              break;
              
            case '5':
              return '/finance_home';
              break; 

            case '6':
              return '/finance_home';
              break;

            case '7':
              return '/finance_home';
              break;
              
            case '8':
              return '/finance_home';
              break;
              
            case '9':
              return '/finance_home';
              break;
              
            case '10':
              return '/finance_home';
              break;
              
            case '11':
              return '/finance_home';
              break;
              
            case '12':
              return '/finance_home';
              break;
              
            case '13':
              return '/finance_home';
              break;
              
            case '14':
              return '/finance_home';
              break;                          

            default:
              return '/logout'; 
            break;
          }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
