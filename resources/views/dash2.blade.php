<!DOCTYPE html>
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
   <!--  <link href="{{ asset('css/mycustomestyle.css') }}" rel="stylesheet"> -->
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
<script>
        jQuery(document).ready(function($){
            $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            });
        })
        </script>
        <style>
            body {
        overflow-x: hidden;
        }

        #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        -webkit-transition: margin .25s ease-out;
        -moz-transition: margin .25s ease-out;
        -o-transition: margin .25s ease-out;
        transition: margin .25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
        color: #fff
        }

        #sidebar-wrapper .list-group {
        width: 15rem;
        }

        #page-content-wrapper {
        min-width: 100vw;
        }

        #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
        }

        @media (min-width: 768px) {
        #sidebar-wrapper {
            margin-left: 0;
        }

        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: -15rem;
        }
        }
        </style>    
    </head>
    <body>
        <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper" style="background-color:#5A5A5A">
        <div class="sidebar-heading">Hitesh Rana Enterprises </div>
        <div class="list-group list-group-flush">
             <label class="nav-links">Home</label></a>
            
        </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color:#5A5A5A">
           
            <img class="header-menu " id="menu-toggle" src="{{asset('images/logo_new.svg')}}" style="height: 50px"> 

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent"  >
           

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

                         <a class="dropdown-item" href="{{route('view_vault')}}"><img class="circle" src="{{asset('images/vault1.svg')}}" style="width: 20px;height: 20px;margin-left: 10px;margin-right: 10px"></a>

                         <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#moddl"><img class="circle" src="{{asset('images/info.svg')}}" style="width: 20px;height: 20px;margin-left: 10px;margin-right: 10px"></a>



                            <div class="dropdown">

                                <a href="{{route('settings')}}" data-bs-toggle="dropdown" aria-expanded="true"> <img class="circle" src="{{asset('images/settings.svg')}}" style="width: 20px;height: 20px;margin-right: 10px;margin-left: 10px;"> </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <!-- <li><a class="dropdown-item" href="{{route('users')}}">User Master</a></li> -->
                                   @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2 OR auth::user()->role_id == 6 OR auth::user()->role_id == 9)
                                     <li><a class="dropdown-item" href="{{route('roles')}}">Role Master</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{route('materials_master')}}">Material Master</a></li>
                                    <li><a class="dropdown-item" href="{{route('department_master')}}">Ticket Department Master</a></li>
                                    <li><a class="dropdown-item" href="{{route('vendor_headings')}}">Vendor Department Master</a></li>

                                   @if(auth::user()->role_id == 1 )
                                    <li>
                                      <a class="dropdown-item" href="#">Recycle & Restore </a>
                                      <ul class="dropdown-menu dropdown-submenu">

                                        <li><a class="dropdown-item" href="{{route('restore-users')}}">Users</a></li>
                                        <li><a class="dropdown-item" href="{{route('restore-customers')}}">Customers</a></li>
                                        <li><a class="dropdown-item" href="{{route('restore-category')}}">Categories</a></li>
                                        <li><a class="dropdown-item" href="{{route('restore-material')}}">Materials</a></li>
                                        <li><a class="dropdown-item" href="{{route('restore_vendors')}}">Vendors</a></li>
                                      </ul>
                                    </li>
                                    @elseif(auth::user()->role_id == 2)
                                       <li><a class="dropdown-item" href="{{route('restore_vendors')}}">Restore Vendors</a></li>
                                    @endif
                                    <!-- <li><a class="dropdown-item" href="{{route('vault_master')}}">Vault</a></li> -->
                                    <li><a class="dropdown-item" href="{{route('view_vault')}}">Vault</a></li>
                                    @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2)
                                    <li><a class="dropdown-item" href="{{ route('year_end_closure')}}">Financial Year Closing</a></li>
                                    @endif

                                     @if(auth::user()->role_id == 1 OR auth::user()->role_id == 2 OR auth::user()->role_id == 3 OR auth::user()->role_id == 4 OR auth::user()->role_id == 5 OR auth::user()->role_id == 6 OR auth::user()->role_id == 7 OR auth::user()->role_id == 9 OR auth::user()->role_id == 10)
                                    <li><a class="dropdown-item" href="{{ route('footprint')}}">Foot Print</a></li>
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
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        </div>
        <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
    </body>
</html>