<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\FootPrint ; 

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

          $footprint = FootPrint::create([
                  'action' => 'Logged In to '.Auth::user()->roles->alias.' Dashboard',
                  'user_id' => Auth::user()->id,
                  'module' => 'Login',
                  'operation' => 'C'
              ]);

          switch ($role) {
            case '1':
               return '/home';
              break;
            case '2':
               return '/home';
              break;

            case '3':
              return '/home';
              break;

            case '4':
              return '/home';
              break;
              
            case '5':
              return '/home';
              break; 

            case '6':
              return '/home';
              break;

            case '7':
              return '/home';
              break;
              
            case '8':
              return '/home';
              break;
              
            case '9':
              return '/home';
              break;
              
            case '10':
              return '/home';
              break;
              
            case '11':
              return '/home';
              break;
              
            case '12':
              return '/home';
              break;
              
            case '13':
              return '/home';
              break;
              
            case '14':
              return '/home';
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
