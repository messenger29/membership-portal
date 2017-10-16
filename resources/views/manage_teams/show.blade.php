@extends('layouts.base')

@section('content')
<h1>Team Dashboard</h1>
<h2>for {{ $team->name }}</h2>
<div class="well">
	<h3>Announcements/Resources</h3>
</div>

<div class="well">
	<h3>Race Registrations</h3>
	@if($race_events)
		@foreach($race_events as $race_event)
			<hr>
			<h4>{{ $race_event->name }}</h4>
			<p>
				Date: {{ $race_event->event_start_date}}@if($race_event->event_end_date) - {{ $race_event->event_end_date }}@endif <br/>
				Location: {{ $race_event->location}}<br/>
				Registration Deadline: {{ $race_event->register_end_date }}
			</p>
			<p><a class="btn btn-default" href="/race/{{ $race_event->id }}/register/{{ $team->id }}">Register for {{ $race_event->name }}</a></p>
		@endforeach
	@else
		<p>No upcoming races has been set yet</p>
	@endif
</div>

<div class="well">
	<h3>Team Managers</h3>
	@foreach($managers as $manager)
		<p><strong>{{ $manager->name }}</strong>, {{ $manager->role}}</p>
	@endforeach
</div>

<div class="well">
	<h3>Access Code</h3>
	<p>{{ $team->access_code }}</p>
	<h3>Team Profile</h3>
	<p>Location: {{ $team->location }}</p>
	<p>Type: {{ $team->type }}</p>
	<p>Year Established: {{ $team->year_established }}</p>
	<p>Bio: {{ $team->bio }}</p>
	<p>Website: {{ $team->website }}</p>
	<p>Facebook: {{ $team->facebook }}</p>
	<p>Twitter: {{ $team->twitter }}</p>
	<p>Instagram: {{ $team->isntagram }}</p>
	<p>Youtube: {{ $team->youtube }}</p>
	<p>Contact email: {{ $team->email }}</p>
	<p><a href="/manage/team/{{ $team->id }}/edit" class="btn btn-default">Edit Team Profile</a></p>
</div>

<div class="well">
	<h3>Team Requests</h3>
	<ul class="list-group">
		@foreach($team_req as $req)
			<li class="list-group-item">{{ $req->name }} <span class="pull-right"><a href="" class="btn btn-default">Confirm</a></li>
		@endforeach
	</ul>
</div>

<div class="well">
	<h3>Team Roster</h3>
	<ul class="list-group">
		@foreach($members as $member)
			<li class="list-group-item">{{ $member->name }}</li>
		@endforeach
	</ul>
</div>
@endsection