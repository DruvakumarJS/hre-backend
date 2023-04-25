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
  

</head>

<body class="body-background">
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light ">
            <div class="container">

               <!--  <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->

               @if(Auth::user()->role_id == 1)

               <a
                href="{{route('home')}}"
                   >
                  <img class="logo" src="{{asset('images/logo.svg')}}">
               </a>

               <div class="navigation">
                    <a href="{{route('view_customers')}}"
                     class="{{request()->routeIs('view_customers')
                        || request()->routeIs('create_customer')
                      ? 'active' : ''}}"
                    >
                      <label class="nav-links">Customers</label></a>

                    <a href="{{route('PCN')}}"
                      class="{{request()->routeIs('PCN')
                      || request()->routeIs('create_pcn')
                      || request()->routeIs('view_pcn')
                      || request()->routeIs('edit_pcn')
                      ? 'active' : ''}}">
                    <label class="nav-links">PCN</label></a>

                    <a href="{{route('intends')}}"
                     class="{{request()->routeIs('intends')
                     ||request()->routeIs('indent_details')
                     ||request()->routeIs('edit_intends')
                      ? 'active' : ''}}">
                      <label class="nav-links">Indents</label></a>

                    <a href="{{route('tickets')}}"
                    class="{{request()->routeIs('tickets')
                      ? 'active' : ''}}">
                    <label class="nav-links" >Tickets</label></a>

                    <a href="{{route('attendance')}}"
                    class="{{request()->routeIs('attendance')
                    ||request()->routeIs('employee-details')
                    ||request()->routeIs('employee-history')
                      ? 'active' : ''}}">
                    <label class="nav-links" >Attendance</label></a>

                    <a href="{{route('pettycash')}}"
                    class="{{request()->routeIs('pettycash')
                      ? 'active' : ''}}">
                      <label class="nav-links" >Petty Cash</label></a>
               </div>

               @elseif(Auth::user()->role_id == 2)

               <a
                href="{{route('manager_home')}}"
                   >
                  <img class="customization_text " src="{{asset('images/logo.svg')}}" style="width: 40px;height: 40px;">
               </a>


               <div class="navigation">
                    <a href="{{route('employee_list')}}"
                     class="{{request()->routeIs('employee_list')
                      ? 'active' : ''}}"
                    ><label class="nav-links">Employee</label></a>

                    <a href="{{route('PCN')}}"
                     class="{{request()->routeIs('PCN')
                     || request()->route('edit_pcn')
                     || request()->routeIs('create_pcn')
                     || request()->routeIs('edit_pcn')
                      ? 'active' : ''}}"
                      ><label class="nav-links">PCN</label></a>

                    <a href="{{route('tickets_list')}}"
                     class="{{request()->routeIs('tickets_list')
                      ? 'active' : ''}}">
                      <label class="nav-links">Tickets</label></a>

                    <!-- <a href="{{route('attendance_list')}}"
                     class="{{request()->routeIs('attendance_list')
                      ? 'active' : ''}}">
                      <label class="nav-links">Attendance</label></a> -->

                    <a href="{{route('petty_cash')}}"
                     class="{{request()->routeIs('petty_cash')
                      ? 'active' : ''}}">
                      <label class="nav-links">Petty Cash</label></a>

               </div>

               @elseif(Auth::user()->role_id == 3)

               <a
                href="{{route('procurement_home')}}"
                   >
                  <img class="customization_text " src="{{asset('images/logo.svg')}}" style="width: 40px;height: 40px;">
               </a>

               <div class="navigation">
                    <a href="{{route('intends')}}"
                     class="{{request()->routeIs('intends')
                     ||request()->routeIs('indent_details')
                     ||request()->routeIs('edit_intends')
                      ? 'active' : ''}}">
                      <label class="nav-links">Indents</label></a>

                    <a href="{{route('ticketslist')}}"
                     class="{{request()->routeIs('ticketslist')
                      ? 'active' : ''}}">
                      <label class="nav-links">Tickets</label></a>
               </div>

               @endif
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

                             <a href=""> <img class="circle" src="{{asset('images/notification.svg')}}" style="width: 20px;height: 20px;"> </a>

                             <a href=""> <img class="circle" src="{{asset('images/mail.svg')}}" style="width: 20px;height: 20px;margin-left: 30px"> </a>

                             @if(Auth::user()->role_id == 1)
                                <div class="dropdown">

                                    <a href="{{route('settings')}}" data-bs-toggle="dropdown" aria-expanded="true"> <img class="circle" src="{{asset('images/settings.svg')}}" style="width: 20px;height: 20px;margin-left: 30px"> </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{route('users')}}">User Master</a></li>
                                        <li><a class="dropdown-item" href="{{route('materials_master')}}">Material Master</a></li>
                                        <li><a class="dropdown-item" href="">Recycle & Restore</a></li>
                                    </ul>
                                </div>
                             @endif

                             <a href=""> <img class="circle" src="{{asset('images/person.svg')}}" style="width: 20px;height: 20px;margin-left: 30px"> </a>

                            <div class="userLogin">
                                <h4> {{ Auth::user()->name }}</h4>
                                <h5>{{Auth::user()->roles->alias }}</h5>
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
</html>
