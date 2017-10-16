@extends('layouts.base')

@section('content')
<h1>{{ $team->name }}</h1>
<h3>Based in {{ $team->location }}</h3>
<div class="well">
	<p>Type: {{ $team->type }}</p>
	<p>Year Established: {{ $team->year_established }}</p>
	<p>Bio: {{ $team->bio }}</p>
	<p>Website: {{ $team->website }}</p>
	<p>Facebook: {{ $team->facebook }}</p>
	<p>Twitter: {{ $team->twitter }}</p>
	<p>Instagram: {{ $team->isntagram }}</p>
	<p>Youtube: {{ $team->youtube }}</p>
	<p>Contact {{ $team->email }} for more info</p>
	<p>Team Managers:</p>
	<ul>
		@foreach($team_managers as $team_manager)
			<li>{{ $team_manager->name }}, {{ $team_manager->role }}</li>
		@endforeach
	</ul>
</div>
@endsection