@extends('members.layout')
@section('content')
	<div class="row padding-top-10">
		@if(isset($orders))
			<table class="striped bordered">
				<caption>My Orders</caption>
				<thead>
					<tr>
						<td>Order Name</td>
						<td>From</td>
						<td>To</td>
						<td>Status</td>
						<td>Type</td>
						<td>Price</td>
						<td>Travel Date</td>
						<td>View</td>
						<td>Edit</td>
						<td>Delete</td>
					</tr>
				</thead>
				<tbody>
				@foreach($orders as $order)
				<tr>
					<td>{{$order->order_name}}</td>
					<td>{{$order->from_city}}</td>
					<td>{{$order->to_city}}</td>
					<td>{{$order->status}}</td>
					<td>{{$order->type}}</td>
					<td>{{$order->price}}</td>
					<td>{{$order->travel_date}}</td>
					<td><i class="material-icons">visibility</i></td>
					<td><i class="material-icons">assignment</i></td>
					<td><i class="material-icons">delete</i></td>
				</tr>
				@endforeach
				</tbody>
			</table>
		@endif
		</div>
@stop