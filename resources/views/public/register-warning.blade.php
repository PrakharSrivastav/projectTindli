@extends("public.layout")
@section("content")
<div class="row margin-none">
    <!-- <div class="col s12  margin-none padding-none">
        <div class="row padding-none margin-none">
            <div class="red darken-2 padding-none margin-none">
                <span class="title padding-none">
                    <a href="{{url('/')}}" class="grey-text text-lighten-3">
                        Tindli
                    </a>
                </span>
            </div>
        </div>
    </div> -->
    <div class="col s12 margin-none margin-top-45 padding-45 center-align">
        <h4 class="light margin-top-10 grey-text text-lighten-4 padding-top-20">{{$status_message}}</h4>
        <p class="center-align light grey-text text-lighten-4 margin-top-20 padding-top-40">Please click on the below button to  <span class="red-text text-darken-2">login</span></p>
        <a href="{{url('/login')}}" class="btn z-depth-0 margin-top-10  center-align red darken-2 grey-text text-lighten-4">Login</a>
    </div>
</div>
@stop