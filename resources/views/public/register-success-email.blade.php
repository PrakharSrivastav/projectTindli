<!DOCTYPE html>
<html>
    <head>
        <title>
            The Account is registered successfully
        </title>
    </head>
    <body style='background-color:#f5f5f5'>
        <div>
            <div align='center' id='header' style='margin:0;padding:10px;background-color:#d32f2f;color:#f5f5f5'>
                <h3 style='font-weight:300'>
                    Tindli
                </h3>
            </div>
            <div class='content' style='margin:0px;padding:20px'>
                <br/>
                Hi {{$user->name}},
                <br/>
                <br/>
                Your account is successfully registered with
                <a href="{{url('/')}}" style='color:#d32f2f'>Tindli</a>
                <br/>
                Please click on the below button to activate your account.
                <br/>
                <br/>
                <br/>
                <a style='padding:10px;border-radius:2px;color:#fff !important;background:#d32f2f' href="{{$user->activation_url}}">
                    Activate
                </a>
                <br/>
                <br/>
                <br/>
                If you are not able to click on the button, you may copy and paste the below link in your browser to activate your account.
                <br/>
                <span style='color:#d32f2f'>
                    {{$user->activation_url}}
                </span>
                <br/>
                <br/>
                Thanks,
                <br/>
                Tindli Admin
            </div>
            <div id='footer' align='center' style='margin:0;padding:30px;background-color:#d32f2f;color:#f5f5f5'>
                <div align='center'>
                    <a href='{{url('/')}}' style='color:#fff !important;margin:5px;font-weight:300'>
                        Home
                    </a>
                    <a href='{{route('login')}}' style='color:#fff !important;margin:5px;font-weight:300'>
                        Login
                    </a>
                    <a href='{{route('register')}}' style='color:#fff !important;margin:5px;font-weight:300'>
                        Register
                    </a>
                    <a href style='color:#fff !important;margin:5px;font-weight:300'>
                        Google
                    </a>
                    <a href style='color:#fff !important;margin:5px;font-weight:300'>
                        Facebook
                    </a>
                    <a href style='color:#fff !important;margin:5px;font-weight:300'>
                        Twitter
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
