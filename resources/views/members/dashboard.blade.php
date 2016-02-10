@extends('members.layout')
@section('content')
	<div class="row padding-top-10">
		@if(isset($users))
			<table class="striped bordered">
				<caption>Other Users in the system</caption>
				<thead>
					<tr>
						<td>First Name</td>
						<td>Last Name</td>
						<td>Email123</td>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{$user->fname}}</td>
					<td>{{$user->lname}}</td>
					<td>{{$user->email}}</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		@endif
		</div>
@stop