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

             <a
                href=""
                   class="list-group-item  py-2 ripple {{ request()->routeIs('customer-dashboard')
                   ? 'active' : '' }}"
                   >
                  <img class="customization_text " src="{{asset('images/logo.svg')}}" style="width: 40px;height: 40px;">
               </a>

               <div>
                    <a href=""><label style="margin-left: 50px">User Master</label></a>
                    <a href="{{route('materials')}}"><label style="margin-left: 20px">Material Master</label></a>
                    <a href=""><label style="margin-left: 50px">PCN</label></a>
                    <a href="{{route('tickets')}}"><label style="margin-left: 50px">Tickets</label></a>
                    <a href=""><label style="margin-left: 50px">Attendance</label></a>
                    <a href=""><label style="margin-left: 50px">Petty Cash</label></a>
               </div>

              

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                           <!--  <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                   
                                </div>
                            </li> -->

                            
                             <a href=""> <img class="circle" src="{{asset('images/notification.svg')}}" style="width: 20px;height: 20px;"> </a>

                             <a href=""> <img class="circle" src="{{asset('images/mail.svg')}}" style="width: 20px;height: 20px;margin-left: 30px"> </a>

                             <a href=""> <img class="circle" src="{{asset('images/settings.svg')}}" style="width: 20px;height: 20px;margin-left: 30px"> </a>

                             <a href=""> <img class="circle" src="{{asset('images/person.svg')}}" style="width: 20px;height: 20px;margin-left: 30px"> </a>
                      
                             <label style="margin-left: 50px ; color: black"> {{ Auth::user()->name }}</label>


                            
                            

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="margin-top: 50px">
            @yield('content')
        </main>
    </div>
</body>
</html>
