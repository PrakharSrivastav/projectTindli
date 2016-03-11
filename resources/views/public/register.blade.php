@extends("public.layout")
@section("content")
<div class="row no-margin  padding-top-40 padding-bottom-40">
    <div class="col m6 padding-bottom-40 push-m3 s12">
        <div class="white" id="register_card">
            <div class="grey-text text-darken-2"	>
                <div class="flow-text padding-top-20 padding-bottom-20 red-text text-darken-2 grey lighten-2 center-align">
                    Sign Up
                </div>
                <form class="col s12 padding-10" id="registration_form" method="post" action="{{route('signup')}}">
                    {{ csrf_field() }}
                    <div class="row no-padding no-margin">
                        <div class="input-field col s12 m6">
                        	@if(Session::has('fname'))
                        	<input id="fname" required value="{{Session::get('fname')}}" name="fname" type="text" placeholder="First Name" class="validate"/>
                        	@else
                        	<input id="fname" name="fname" type="text" placeholder="First Name" class="validate" required/>
                        	@endif
                        	<label for="fname">First Name</label>
                            <div class="light darken-3 red-text">
                            	@if($errors->first('fname') != null)
									{{$errors->first('fname')}}
                            	@endif
                            </div>
                        </div>
                        <div class="input-field col s12 m6">
                        	@if(Session::has('fname'))
                        	<input id="lname" name="lname" value="{{Session::get('lname')}}" placeholder="Last Name" type="text" class="validate" required/>
                        	@else
                        	<input id="lname" name="lname" placeholder="Last Name" type="text" class="validate" required/>
                        	@endif
                        	<label for="lname">Last Name</label>
                            <div  class="light darken-3 red-text">
                                @if($errors->first('lname') != null)
									{{$errors->first('lname')}}
                            	@endif
                            </div>
                        </div>
                    </div>
                    <div class="row no-padding no-margin grey-text text-darken-2">
                        <div class="input-field col s12 m6">
                            <input id="password" name="password" placeholder="Password" type="password" class="validate" required/>
                            <label for="password">Password</label>
                            <div  class="light darken-3 red-text">
                            	@if($errors->first('password') != null)
									{{$errors->first('password')}}
                            	@endif
                            </div>
                        </div>
                        <div class="input-field col s12 m6">
                            <input id="c_password" name="c_password" placeholder="Confirm Password" type="password" class="validate" required/>
                            <label for="c_password">Confirm Password</label>
                            <div  class="light darken-3 red-text">
                                @if($errors->first('c_password') != null)
									{{$errors->first('c_password')}}
                            	@endif
                            </div>
                        </div>
                    </div>
                    <div class="row no-padding no-margin">
                        <div class="input-field col s12 m6">
                        	@if(Session::has('email'))
                        	<input id="email" value="{{Session::get('email')}}" type="email" name="email" placeholder="Email" class="validate" required/>
                            @else
                        	<input id="email" type="email" name="email" placeholder="Email" class="validate" required/>
                            @endif
                            <label for="email">Email-id</label>
                            <div  class="light darken-3 red-text">
                                @if($errors->first('email') != null)
									{{$errors->first('email')}}
                            	@endif
                            </div>
                        </div>
                        <div class="input-field  col s12 m6">
                            <p>
						      <input type="checkbox" class="filled-in" id="tnc" name='tnc' checked="checked" required/>
						      <label for="tnc">Please accept Terms and conditions</label>
						    </p>
                            <div  class="light darken-3 red-text">
	                            @if($errors->first('tnc') != null)
									{{$errors->first('tnc')}}
	                            @endif
                            </div>
                            <!-- </p> -->
                        </div>
                    </div>
                    <div class="row no-padding ">
                        <div class="input-field col s12">
                            <input value="Register" type="submit" class="btn-large red darken-2 btn btn-block">
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </form>
                <div style="clear:both"></div>
            </div>
            <div style="clear:both"></div>
            <div class="card-action grey lighten-2 padding-20">
                <a href="{{route('tnc')}}" class="red-text darken-2">
                    Read Terms and conditions
                </a>
            </div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
    </div>
    <div style="clear:both"></div>
</div>
@stop
@section('javascript')
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/app.validate.js"></script>
@stop
