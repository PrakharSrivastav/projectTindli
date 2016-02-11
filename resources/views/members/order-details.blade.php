@extends('members.layout')
@section('content')
<div class="row margin-top-30">
    <div class="col s12 m3">
        <img src="http://rndimg.com/ImageStore/OilPaintingBlue/200x200_OilPaintingBlue_4a032d07798e4ba9b5c72ef9bc158442.jpg" class="responsive-img full-width"/>
    </div>
    <div class="col s12 m6 padding-10">
    	<div><strong class="font-17">Order Number : </strong><span>{{$order->order_name}}</span></div>
    	<div><strong class="font-17">From : </strong><span>{{$order->from_city}}</span></div>
    	<div><strong class="font-17">To : </strong><span>{{$order->to_city}}</span></div>
    	<div><strong class="font-17">To be shipped by : </strong><span>{{$order->travel_date}}</span></div>
    	<div><strong class="font-17">Status : </strong><span>{{$order->status}}</span></div>
    	<div><strong class="font-17">Type : </strong><span>{{$order->type}}</span></div>
    	<div><strong class="font-17">Size : </strong><span>{{$order->size}}</span></div>
    	<div><strong class="font-17">Price : </strong><span>{{$order->price}}</span></div>
    </div>
    <div class="col s12 m3 padding-10">
        <!-- Modal Trigger -->
        <a class="waves-effect waves-light btn btn-block modal-trigger" href="#modal1">Apply to Carry</a>
        <a class="waves-effect waves-light btn btn-block margin-top-5 red" id="cancel_request">Cancel Request</a>
    </div>
    <div class="col s12">
    	<strong class="font-17">Description : </strong><span>{{$order->description}}</span>
    </div>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal" style="height:auto !important">
    <div class="modal-footer center-align">
        <h5>Apply : Order - [{{$order->order_name}}]</h5>
    </div>
    <div class="modal-content no-margin" style="height:auto">
        <div class="no-padding no-margin">You are applying to carry the order number <strong>{{$order->order_name}}</strong> between the locations <strong>{{$order->from_city}}</strong> and <strong>{{$order->to_city}}</strong>. This package has to be delivered on or before <strong>{{$order->travel_date}}</strong>.<br><small>* By, clicking on the button below, you would be applying for crraying this order.<br>* The sender will contact you if he choses you to carry this package.<br>* You can cancel this request by clicking the cancel button.</small></div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn z-depth-0 modal-action modal-close left">Cancel</a>
        <a href="#" id="confirm_application" class="btn z-depth-0 modal-action modal-close">Confirm</a>
    </div>
    <input type="hidden" id="_token" value="{{csrf_token()}}">
</div>
@stop
@section('javascript')
<script>
    var applyToCarry = "{{route('apply',['order_id'=>$order->id])}}";
    var cancelToCarry = "{{route('cancel',['order_id'=>$order->id])}}";
</script>
<script type="text/javascript" src="{{url('js/features.js')}}"></script>
@stop