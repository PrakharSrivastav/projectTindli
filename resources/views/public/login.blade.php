@extends("public.layout")
@section('content')
<div class="row no-margin  padding-top-40 padding-bottom-40">
        <div class="col padding-bottom-40 l4 push-l4 s12 m6 push-m3">
            <div class="white" style="min-height:530px">
                <div class="grey-text text-darken-2">
                    <div class="flow-text padding-top-15 padding-bottom-15 center-align red-text text-darken-2 grey lighten-2">Login</div>
                    <div class="row no-margin  grey lighten-2">
                        <div class="input-field col s12">
                            <button type="button" class="light waves-effect red darken-1 btn btn-block">Login with google</button>
                        </div>
                    </div>
                    <div class="row no-margin padding-bottom-20 grey lighten-2">
                        <div class="input-field col s12">
                            <button type="button" class="light waves-effect blue darken-4 btn btn-block">Login with facebook</button>
                        </div>
                    </div>
                    <div class="row padding-top-15 margin-top-15 grey-text text-darken-2">
                        <div class="col s5"><hr></div>
                        <div class="col s2 center-align">OR</div>
                        <div class="col s5"><hr></div>
                        <form class="col s12 padding-10" id="login_form" method="post" action="{{route('attempt_login')}}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="input-field col s12 no-padding">
                                    <!-- <i class="material-icons prefix margin-top-15">perm_identity</i> -->
                                    @if(Session::has('email'))
                                        <input id="email" value="{{Session::get('email')}}" type="email" name="email" class="validate">
                                    @else
                                        <input id="email" type="email" name="email" class="validate">
                                    @endif
                                    <label for="email">Your Email Address</label>
                                    <div class="light left-align red-text darken-3">
                                        @if($errors->first('email') != null)
                                            {{$errors->first('email')}}
                                        @endif
                                    </div>
                                </div>
                                <div class="input-field col s12 no-padding">
                                    <!-- <i class="material-icons prefix margin-top-15">vpn_key</i> -->
                                    <input id="password" type="password" name="password" class="validate">
                                    <label for="password">Password</label>
                                    <div class="light left-align darken-3 red-text">
                                        @if($errors->first('password') != null)
                                            {{$errors->first('password')}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="light left-align red-text darken-3"></div>
                                <div class="input-field col s12">
                                    <button type="submit" class="waves-effect red darken-2 btn btn-block">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="clear" style="clear:both;"></div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/app.validate.js"></script>
@stop