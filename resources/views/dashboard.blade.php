@extends('layouts.base')

@section('content')
<h1>Membership Dashboard</h1>
<h2>for {{ $name }} </h2>
<div class="row">
	<div class="col-md-4">
		<div class="well">
			<h3>{{ $currentYear }} Status</h3>
			<ul class="list-group">
				<li class="list-group-item"><a href="/profiles">Profile</a> Status <span class="badge">{{ $profile_flag }}</span></li>
				<li class="list-group-item"><a href="/waivers">Waiver</a> Status <span class="badge">{{ $waiver_flag }}</span></li>
				<li class="list-group-item"><a href="/membership">Membership</a> Status <span class="badge">{{ $membership_flag }}</span></li>
			</ul>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<h3>Certifications</h3>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="well">
			<h3>Team Paddling</h3>
			@if($active_team)
				<p>Name: {{ $active_team->name }}</p>
				<p>Status: Active</p>
				<p><a href="/teams/{{ $active_team->id }}" class="btn btn-default">Team Page</a></p>
			@elseif($request_team)
				<p>Name: {{ $request_team->name }}</p>
				<p>Status: Requested</p>
				<p><a href="/teams/{{ $request_team->id }}" class="btn btn-default">Team Page</a></p>
			@else
				<input type="text" placeholder="team code">
				<p><a href="">Join Team</a></p>
			@endif
		</div>
	</div>
	@if($teams_manage->count())
	<div class="col-md-4">
		<div class="well">
			<h3>Team(s) Management</h3>
			<ul class="list-group">
			@foreach($teams_manage as $team_manage)
				<li class="list-group-item">Team: {{ $team_manage->name }}<br/>Role: {{ $team_manage->role }}<br/> <a href="/manage/team/{{ $team_manage->id }}">Team Page</a></li>
			@endforeach
			</ul>
		</div>
	</div>
	@endif
</div>
@endsection