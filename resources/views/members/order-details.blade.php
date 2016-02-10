@extends('members.layout')
@section('content')
<div class="row margin-top-30">
    <div class="col s12 m3">
        <img src="http://rndimg.com/ImageStore/OilPaintingBlue/200x200_OilPaintingBlue_4a032d07798e4ba9b5c72ef9bc158442.jpg" class="responsive-img full-width"/>
    </div>
    <div class="col s12 m9 padding-10">
    	<div><strong class="font-17">Order Number : </strong><span>{{$order->order_name}}</span></div>
    	<div><strong class="font-17">From : </strong><span>{{$order->from_city}}</span></div>
    	<div><strong class="font-17">To : </strong><span>{{$order->to_city}}</span></div>
    	<div><strong class="font-17">To be shipped by : </strong><span>{{$order->travel_date}}</span></div>
    	<div><strong class="font-17">Status : </strong><span>{{$order->status}}</span></div>
    	<div><strong class="font-17">Type : </strong><span>{{$order->type}}</span></div>
    	<div><strong class="font-17">Size : </strong><span>{{$order->size}}</span></div>
    	<div><strong class="font-17">Price : </strong><span>{{$order->price}}</span></div>
    </div>
    <div class="col s12">
    	<strong class="font-17">Description : </strong><span>{{$order->description}}</span>
    </div>
    <hr>
    <div class="col s12">
		<h5>Request to carry</h5>
		<form class="row">
	        <div class="input-field col s12">
	          <textarea id="textarea1" class="materialize-textarea"></textarea>
	          <label for="textarea1">Message</label>
	        </div>
	    	<div class="col s12"><button class="btn">Send Message</button></div>
	    </form>
    </div>
</div>
@stop
