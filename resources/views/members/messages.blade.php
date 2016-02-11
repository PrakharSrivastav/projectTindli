@extends('members.layout')
@section('content')
<div class="white row padding-top-20" style="min-height:550px">
    <div class="col s12 m2 no-padding">
        <div class="col s12 no-margin no-padding padding-top-40"  style="min-height:540px">
            <div class="collection no-margin">
                @if(isset($all_data))
                @foreach($all_data as $sender=>$val)
                <a href="#!" id="{{str_replace(' ','_',$sender)}}" data-user="{{$val[0]['sender_id']}}" class="collection-item red darken-2 grey-text text-lighten-3 name">{{$sender}}</a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col s12 m10 padding-left-10">
        <div class="col s12 no-margin no-padding">
            <div class="row padding-10">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="message" class="materialize-textarea"></textarea>
                            <label  for="message">Your Message Here</label>
                            <span class="red-text" id="message_error"></span>
                        </div>
                        <input type="hidden" value="" id="message_to"/>
                        <input type="hidden" value="{{csrf_token()}}" id="csrf_token"/>
                    </div>
                    <div class="margin-left-10">
                        <button type="button" id="send_message" class="red darken-2 text-grey text-lighten-3 btn">Reply</button>
                    </div>
                </form>
            </div>
            <div class="row padding-20">
                <ul class="collection with-header">
                    <li class="collection-header light red"><h5 class="white-text">Previous Conversations</h5></li>
                    @if(isset($all_data))
                        @foreach($all_data as $each=>$value)
                            @foreach($value as $every)
                                @if($every['read'] == '1' && $every['reader']==$user->id)
                                <li data-attr-id="{{$every['id']}}" class="collection-item avatar yellow {{str_replace(' ','_',$each)}} news">
                                    <img src="{{$every['s_img'] }}" alt="" class="circle">
                                    <span class=""><span class="blue-text text-darken-4">{{$every['s_navn']}}</span> @ {{$every['created_at']}}</span>
                                    <p>{{$every['message']}}</p>
                                    <a href="#!" class="secondary-content">
                                        <i class="tiny black-text material-icons">visibility_off</i>
                                    </a>
                                </li>
                                @else
                                <li data-attr-id="{{$every['id']}}" class="collection-item avatar {{str_replace(' ','_',$each)}} news">
                                    <img src="{{$every['s_img'] }}" alt="" class="circle">
                                    <span class=""><span class="blue-text text-darken-4">{{$every['s_navn']}}</span> @ {{$every['created_at']}}</span>
                                    <p>{{$every['message']}}</p>
                                    <a href="#!" class="secondary-content">
                                        <i class="tiny black-text material-icons">visibility</i>
                                    </a>
                                </li>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@stop
@section('javascript')
<script>
$(".news").hide();
$(document).ready(function($) {
    $(".collection-item").click(function() {
        msg_clicked = $(this);
        if (msg_clicked.hasClass('yellow')) {
            message_id = msg_clicked.attr("data-attr-id");
            msg_clicked.removeClass('yellow');
            msg_clicked.addClass('white');
            icon = msg_clicked.find('i.material-icons');
            icon.html("visibility");
            $.ajax({
                url: "{{route('markasread')}}",
                type: 'GET',
                dataType: 'json',
                data: {message_id: message_id},
            }).done(function(a) {
                cnt = $(".message_count");
                if (a.length > 0) {
                    cnt.empty();
                    cnt.text(a.length);
                } else {
                    cnt.empty();
                }
            }).fail(function() {
                 cnt.empty();
            });
        }
    });

    @if(isset($first_sender['name']) && $first_sender['name'] != "")
    $(".{{$first_sender['name']}}").show();
    $("#message_to").val("{{$first_sender['id']}}");
    @endif
    $("#message").val("");
    $(".name").click(function(e) {
        e.preventDefault();
        console.log($(this));
        id = $(this).attr("id");
        to = $(this).attr("data-user");
        $(".news").hide();
        if (id !== "") $("." + id).show();
        $("#message_to").val(to);
        $("#message").val("");
    });
    $("#send_message").click(function(e) {
        e.preventDefault();
        console.log($("#message_to").val());
        message = $.trim($("#message").val());
        if (message == "" || message == undefined) {
            $("#message_error").empty();
            $("#message_error").text("The Message is blank. Please write a message");
        } else if($("#message_to").val() == "" || $("#message_to").val() == undefined){
            $("#message_error").empty();
            $("#message_error").text("You have no messages to reply. You can only reply only to the requests from other users.");
        } else {
            $("#message_error").empty();
            data = {
                text: message,
                to: $("#message_to").val(),
                _token: $("#csrf_token").val()
            };
            $.ajax({
                url: "{{route('send_message')}}",
                type: 'get',
                dataType: 'json',
                data: data,
            }).done(function(a) {
                Materialize.toast(a.message, 5000);
                return false;
            }).fail(function(a) {
                Materialize.toast("You are not allowed to perform this operation", 5000);
                return false;
            }).always(function(a) {
                // location.reload();
            });
        }
    });
});    
</script>
@stop