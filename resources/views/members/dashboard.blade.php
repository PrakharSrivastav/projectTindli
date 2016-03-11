@extends('members.layout')
@section('content')
	<div class="row margin-top-30">
		@if(isset($users))
			<table class="dashboard-table striped bordered">
				<caption  class="margin-bottom-10">Other Users in the system</caption>
				<thead>
					<tr>
						<td>First Name</td>
						<td>Last Name</td>
						<td>Email123</td>
						<td>Created On</td>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{$user->fname}}</td>
					<td>{{$user->lname}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->created_at->format('Y-m-d')}}</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		@endif
		</div>
@stop