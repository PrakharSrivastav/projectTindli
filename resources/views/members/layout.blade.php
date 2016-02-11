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
    <body >
            <div class="navbar ">
            <nav class="z-depth-0 container" style="background-color:transparent;">
                <div class="nav-wrapper">
                  <a href="{{url('/')}}" class="brand-logo black-text">TINDLI</a>
                  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons black-text">menu</i></a>
                  <ul class="right hide-on-med-and-down">
                    <!-- <li><a href="" class="black-text">Track Shipment</a></li> -->
                    <li><a href="{{route('orders')}}" class="black-text">Order History</a></li>
                    <li><a href="{{route('messages')}}" class="black-text">Messages<span class="weight-600 red-text padding-left-5 message_count"></span></a></li>
                    <li><a href="{{route('requests')}}" class="black-text">Requests</a></li>
                    <!-- <li><a href="" class="black-text">Carry History</a></li> -->
                    <li><a href="{{route('dashboard')}}" class="black-text">Dashboard</a></li>
                    <!-- <li><a href="{{route('register')}}" class="black-text">Register</a></li> -->
                    <li><a class="btn red right margin-top-15 white-text" href="{{route('logout')}}">logout</a></li>
                  </ul>
                  <ul class="side-nav" id="mobile-demo">
                    <!-- <li><a href="" class="black-text">Track Shipment</a></li> -->
                    <li><a href="{{route('orders')}}" class="black-text">Order History</a></li>
                    <li><a href="{{route('messages')}}" class="black-text">Messages<span class="weight-600 red-text padding-left-5 message_count"></span></a></li>
                    <li><a href="{{route('requests')}}" class="black-text">Requests</a></li>
                    <!-- <li><a href="" class="black-text">Carry History</a></li> -->
                    <li><a href="{{route('dashboard')}}" class="black-text">Dashboard</a></li>
                    <!-- <li><a href="{{route('register')}}" class="black-text">Register</a></li> -->
                    <li><a class="btn red right margin-top-15 white-text" href="{{route('logout')}}">logout</a></li>
                  </ul>
                </div>
            </nav>
        </div>
        <div class="row container" id="content">
            @yield('content')
        </div>
        <!-- Scripts -->
        <script src="{{url('js/jquery.min.js')}}"></script>
        <script src="{{url('js/tindli.min.js')}}"></script>
        <script src="{{url('js/init.js')}}"></script>
        <script>var unreadCount = "{{route('unread_messages')}}";</script>
        <script>
            var cnt = $(".message_count");
            $.ajax({
                url: unreadCount,
                type: 'GET',
                dataType: 'json',
            }).done(function(a) {
                if(a.length > 0){
                  cnt.empty();
                  cnt.text(a.length);
                }
                else{
                  cnt.empty();
                }
            }).fail(function(a) {
                cnt.empty();
            });
        </script>
        @yield('javascript')
    </body>
</html>
