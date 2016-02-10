@extends('public.nobg-layout')
@section('content')
	<div class="container">
	@if(isset($orders))
		<table class="striped bordered">
			<caption>My Orders</caption>
			<thead>
				<tr>
					<td>From</td>
					<td>To</td>
					<td>Type</td>
					<td>Price</td>
					<td>Size</td>
					<td>Travel Date</td>
					<td>Carry</td>
				</tr>
			</thead>
			<tbody>
			@foreach ($orders as $order)
				<tr>
					<td>{{$order->from_city}}</td>
					<td>{{$order->to_city}}</td>
					<td>{{$order->type}}</td>
					<td>{{$order->price}}</td>
					<td>{{$order->size}}</td>
					<td>{{$order->travel_date}}</td>
					<td><a href="{{route('get_order',['order_name'=>$order->order_name])}}"><i class="material-icons">comment</i></a></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	@endif
	</div>
@stop