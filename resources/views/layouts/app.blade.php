 <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mycustomestyle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="noreferrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>

<body class="body-background">
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light ">
            <div class="container">

               <!--  <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->

               <div class="d-flex flex-column text-center" >
                   
                    <img class="logo" src="{{asset('images/logo_new.svg')}}">
                
               </div>

               
             
               <div class="navigation">
                    <a href="{{route('home')}}"
                     class="{{request()->routeIs('home')
                      ? 'active' : ''}}"
                      >
                      <label class="nav-links">Home</label></a>
                  @if(Auth::user()->role_id =='1' OR Auth::user()->role_id =='2' OR Auth::user()->role_id =='3' OR Auth::user()->role_id =='4' OR Auth::user()->role_id =='5' OR Auth::user()->role_id =='6' OR Auth::user()->role_id =='7' OR Auth::user()->role_id =='8' OR Auth::user()->role_id =='9' OR Auth::user()->role_id =='10' OR Auth::user()->role_id =='11')
                    <a href="{{route('view_customers')}}"
                     class="{{request()->routeIs('view_customers')
                        || request()->routeIs('create_customer')
                        || request()->routeIs('search_customer')
                        || request()->routeIs('edit_customer')
                      ? 'active' : ''}}"
                    >
                      <label class="nav-links">Customers</label></a>
                  @endif
                    <a href="{{route('PCN')}}"
                      class="{{request()->routeIs('PCN')
                      || request()->routeIs('create_pcn')
                      || request()->routeIs('search_pcn')
                      || request()->routeIs('view_pcn')
                      || request()->routeIs('edit_pcn')
                      || request()->routeIs('search_pcn_details')
                      ? 'active' : ''}}">
                    <label class="nav-links">PCN</label></a>

                    <a href="{{route('intends')}}"
                     class="{{request()->routeIs('intends')
                     ||request()->routeIs('indent_details')
                     ||request()->routeIs('create_indent')
                     ||request()->routeIs('edit_intends')
                     ||request()->routeIs('filter_indents')
                     || request()->routeIs('search_indent')
                     ||request()->routeIs('grn')
                     || request()->routeIs('search_grn')
                      ? 'active' : ''}}">
                      <label class="nav-links">Indents</label></a>

                    <a href="{{route('tickets')}}"
                    class="{{request()->routeIs('tickets')
                    || request()->routeIs('edit-ticket')
                    || request()->routeIs('ticket-details')
                    || request()->routeIs('generate-ticket')
                    || request()->routeIs('filter')
                    || request()->routeIs('search_ticket')
                      ? 'active' : ''}}">
                    <label class="nav-links" >Tickets</label></a>
                  
                 
                    <a href="{{route('attendance')}}"
                    class="{{request()->routeIs('attendance')
                    ||request()->routeIs('employee-details')
                    ||request()->routeIs('employee-history')
                    ||request()->routeIs('get_attendance_by_date')
                    ||request()->routeIs('search_attendance')
                    ||request()->routeIs('search_attendance_by_date')
                    ||request()->routeIs('search_user_attendance')
                    ||request()->routeIs('search_employee')
                      ? 'active' : ''}}">
                    <label class="nav-links" >Attendance</label></a>

                    <a href="{{route('pettycash')}}"
                    class="{{request()->routeIs('pettycash')
                    ||request()->routeIs('edit_pettycash')
                    ||request()->routeIs('create_new')
                    ||request()->routeIs('details_pettycash')
                    ||request()->routeIs('update_bill_status')
                    ||request()->routeIs('pettycash_info')
                    ||request()->routeIs('view_summary')
                    ||request()->routeIs('pettycash_expenses')
                    ||request()->routeIs('search_pettycash')
                      ? 'active' : ''}}">
                      <label class="nav-links" >Petty Cash</label></a>
               </div>

             
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto" style="margin-top: 20px">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                              
                            <!--  <a href="{{route('notification', Auth::user()->id)}}" class="notification"> <img class="circle" src="{{asset('images/notification.svg')}}" style="width: 20px;height: 20px;"> </a> -->
                           <!--  <div class="dropdown">
                               <a data-bs-toggle="dropdown" aria-expanded="true"> <img class="circle" src="{{asset('images/info.svg')}}" style="width: 20px;height: 20px;margin-left: 30px"> </a>

                                 <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#moddl">About</a></li>
                                        
                                        <li><a class="dropdown-item" href="{{route('vault_master')}}">Vault</a></li>

                                    </ul>
                             </div> -->

                             <a class="dropdown-item" href="{{route('vault_master')}}"><img class="circle" src="{{asset('images/vault1.svg')}}" style="width: 20px;height: 20px;margin-left: 10px;margin-right: 10px"></a>

                             <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#moddl"><img class="circle" src="{{asset('images/info.svg')}}" style="width: 20px;height: 20px;margin-left: 10px;margin-right: 10px"></a>


                           
                                <div class="dropdown">

                                    <a href="{{route('settings')}}" data-bs-toggle="dropdown" aria-expanded="true"> <img class="circle" src="{{asset('images/settings.svg')}}" style="width: 20px;height: 20px;margin-right: 10px;"> </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{route('users')}}">User Master</a></li>
                                        @if(auth::user()->id == 1)
                                         <li><a class="dropdown-item" href="{{route('roles')}}">Role Master</a></li>
                                        @endif
                                        <li><a class="dropdown-item" href="{{route('materials_master')}}">Material Master</a></li>
                                        <li><a class="dropdown-item" href="{{route('department_master')}}">Department Master</a></li>
                                       
                                       @if(auth::user()->role_id == 1)
                                        <li>
                                          <a class="dropdown-item" href="#">Recycle & Restore </a>
                                          <ul class="dropdown-menu dropdown-submenu">
                                            <li><a class="dropdown-item" href="{{route('restore-users')}}">Users</a></li>
                                            <li><a class="dropdown-item" href="{{route('restore-customers')}}">Customers</a></li>
                                            <li><a class="dropdown-item" href="{{route('restore-category')}}">Categories</a></li>
                                            <li><a class="dropdown-item" href="{{route('restore-material')}}">Materials</a></li>
                                          </ul>  
                                        </li> 
                                        @endif
                                        <li><a class="dropdown-item" href="{{route('vault_master')}}">Vault</a></li>
                                        <!-- <li><a class="dropdown-item" href="{{route('view_vault')}}">Vault</a></li> -->
                                        @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2)
                                        <li><a class="dropdown-item" href="{{ route('year_end_closure')}}">Financial Year Closing</a></li>
                                        @endif

                                       <!--  @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2)
                                        <li><a class="dropdown-item" href="{{ route('year_end_closure')}}">Foot Print</a></li>
                                        @endif -->

                                    </ul>
                                </div>

                          
                             <a href=""> <img class="circle" src="{{asset('images/persons.svg')}}" style="width: 20px;height: 20px;margin-left: 10px;"> </a>

                            <div class="userLogin">
                                <h4 style="width: 100px"> {{ Auth::user()->name }}</h4>
                               
                                <h5 style="width: 100px">{{Auth::user()->roles->alias }}</h5>
                            </div>

                               <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>




                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="margin-top: 80px">
            @yield('content')
        </main>
    </div>
</body>


<!-- Modal -->
        <div class="modal fade" id="moddl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">About</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-header text-white label-bold  align-items-center d-flex justify-content-center" style="background-color: #f10909;;font-family: sans-serif;">Web Application Specification</div>
                    <div class="card-body">
                       <div>
                        <label style="font-family: sans-serif;">App Name :</label> <label style="font-size: 17px;font-family: sans-serif;">HRE Dashbaord</label>
                      </div>

                      <div style="margin-top: 10px">
                        <label style="font-family: sans-serif;">Version :</label> <label style="font-size: 17px;font-family: sans-serif;">1.0</label>
                      </div>

                       <div style="margin-top: 10px">
                        <label style="font-family: sans-serif;">System Type :</label> <label style="font-size: 17px;font-family: sans-serif;">64-bit operationg system</label>
                      </div>

                      <div style="margin-top: 10px">
                        <label style="font-family: sans-serif;">Interactive :</label> <label style="font-size: 17px;font-family: sans-serif;">Yes</label>
                      </div>

                      <div style="margin-top: 10px">
                        <label style="font-family: sans-serif;">Help :</label> <label class="label-bold" style="color: blue";font-family: sans-serif;>Kamal@hresolutions.in</label>
                      </div>

                      <div style="margin-top: 10px">
                        <label style="font-family: sans-serif;">Concept Designer :</label><label style="font-size: 17px;font-family: sans-serif;" >Kamala Kannan R</label>
                      </div>

                      <div style="margin-top: 10px">
                        <label style="font-family: sans-serif;">App developer :</label> <label style="font-size: 17px;font-family: sans-serif;">Netiapps Software Pvt. Ltd.</label>
                      </div>

                      <div>
                        <label style="font-size: 17px;font-family: sans-serif;" >Netiapps #406, 9th Main Rd, HRBR Layout 1st Block, HRBR Layout, Kalyan Nagar, Bengaluru, Karnataka 560043</label>
                      </div>
                       
                    </div>
                  
                </div>
                
              </div>
              
            </div>
          </div>
        </div>
<!-- Modal -->

</html>
