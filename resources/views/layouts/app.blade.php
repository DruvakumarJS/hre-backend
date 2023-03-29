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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mycustomestyle.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    
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
                  <img class="customization_text " src="{{asset('images/logo.svg')}}" style="width: 40px;height: 40px;">
               </a>


               <div>
                    <a href="{{route('users')}}"><label class="nav-links" style="margin-left: 20px">User Master</label></a>

                    <a href="{{route('materials')}}"><label class="nav-links" style="margin-left: 20px">Material Master</label></a>
                   

                    <a href="{{route('PCN')}}"><label class="nav-links" style="margin-left: 30px">PCN</label></a>
                  

                    <a href="{{route('tickets')}}"><label class="nav-links" style="margin-left: 30px">Tickets</label></a>
                   

                    <a href="{{route('attendance')}}"><label class="nav-links" style="margin-left: 30px">Attendance</label></a>
                  

                    <a href="{{route('pettycash')}}"><label class="nav-links" style="margin-left: 30px">Petty Cash</label></a>

                    
               </div>

               @elseif(Auth::user()->role_id == 2)

               <a
                href="{{route('manager_home')}}"
                   >
                  <img class="customization_text " src="{{asset('images/logo.svg')}}" style="width: 40px;height: 40px;">
               </a>


               <div>
                    <a href=""><label class="nav-links" style="margin-left: 20px">Employee</label></a>

                    <a href=""><label class="nav-links" style="margin-left: 20px">Intend</label></a>

                    <a href="{{route('tickets')}}"><label class="nav-links" style="margin-left: 30px">Tickets</label></a>
                   

                    <a href="{{route('attendance')}}"><label class="nav-links" style="margin-left: 30px">Attendance</label></a>

                    <a href="{{route('pettycash')}}"><label class="nav-links" style="margin-left: 30px">Petty Cash</label></a>
                  
               </div>

               @elseif(Auth::user()->role_id == 3)

               <a
                href="{{route('procurement_home')}}"
                   >
                  <img class="customization_text " src="{{asset('images/logo.svg')}}" style="width: 40px;height: 40px;">
               </a>

               <div>
                    <a href="{{route('intends')}}"><label class="nav-links" style="margin-left: 20px">Intends</label></a>
                   
                    <a href="{{route('tickets')}}"><label class="nav-links" style="margin-left: 30px">Tickets</label></a>
                   

                  
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

                             <a href=""> <img class="circle" src="{{asset('images/settings.svg')}}" style="width: 20px;height: 20px;margin-left: 30px"> </a>

                             <a href=""> <img class="circle" src="{{asset('images/person.svg')}}" style="width: 20px;height: 20px;margin-left: 30px"> </a>
                            
                              <label style="margin-left: 20px ; color: black"> {{ Auth::user()->name }}</br>{{Auth::user()->role }}</label>

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
