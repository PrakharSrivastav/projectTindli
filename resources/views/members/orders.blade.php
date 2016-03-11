@extends('members.layout')
@section('content')
	<div class="row margin-top-30">
		@if(isset($orders))
			<table class="dashboard-table striped bordered">
				<caption  class="margin-bottom-10">My Orders</caption>
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
					<td>{{$order->travel_date->format('Y-m-d')}}</td>
					<td class='center-align'><i class="tiny  material-icons">visibility</i></td>
					<td class='center-align'><i class="tiny  material-icons">assignment</i></td>
					<td class='center-align'><i class="tiny  material-icons">delete</i></td>
				</tr>
				@endforeach
				</tbody>
			</table>
		@endif
		</div>
@stop