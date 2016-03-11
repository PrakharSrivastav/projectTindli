<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>Tindli</title>
        <!-- CSS -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <link href="{{url('css/tindli.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="{{url('css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
        @yield('css')
    </head>
    <body>
            <div class="navbar ">
            <nav class="z-depth-0 container" style="background-color:transparent;">
                <div class="nav-wrapper">
                  <a href="{{url('/')}}" class="brand-logo black-text">TINDLI</a>
                  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                  <ul class="right hide-on-med-and-down">
                    <!-- <li class="active"><a href="" class="black-text">Track Shipment</a></li> -->
                    <li><a href="{{url('login')}}" class="black-text">Login</a></li>
                    <li><a href="{{url('register')}}" class="black-text">Register</a></li>
                  </ul>
                  <ul class="side-nav" id="mobile-demo">
                    <!-- <li><a href="" class="black-text">Track Shipment</a></li> -->
                    <li><a href="{{url('login')}}" class="black-text">Login</a></li>
                    <li><a href="{{url('register')}}" class="black-text">Register</a></li>
                  </ul>
                </div>
            </nav>
        </div>
        <div class="row" id="content">
            @yield('content')
        </div>
        <!-- Scripts -->
        <script src="{{url('js/jquery.min.js')}}"></script>
        <script src="{{url('js/tindli.min.js')}}"></script>
        <script src="{{url('js/init.js')}}"></script>
        @yield('javascript')
    </body>
</html>
