@extends('members.layout')
@section('content')
	<div class="row margin-top-30">
		@if(isset($required))
			<table class="dashboard-table striped bordered">
				<caption class="margin-bottom-10">My Recieved Requests</caption>
				<thead>
					<tr>
						<td>Order Name</td>
						<td>Applicant</td>
						<td>Order Status</td>
						<td>Source</td>
						<td>Destination</td>
						<td>Travel Date</td>
						<td>Created On</td>
						<td>View</td>
					</tr>
				</thead>
				<tbody>
				@foreach($required as $req)
				<tr>
					<td>{{$req['order_name']}}</td>
					<td>{{$req['applier']}}</td>
					<td>{{$req['status']}}</td>
					<td>{{$req['from']}}</td>
					<td>{{$req['to']}}</td>
					<td>{{$req['travel_date']}}</td>
					<td>{{$req['created_at']}}</td>
					<td class='center-align'><i class="tiny material-icons">visibility</i></td>
				</tr>
				@endforeach
				</tbody>
			</table>
		@endif
		</div>
@stop