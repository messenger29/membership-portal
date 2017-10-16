@extends('layouts.base')

@section('content')
<h1>Team Management</h1>
@if($teams_manage->count())
	<ul class="list-group">
	@foreach($teams_manage as $team_manage)
		<li class="list-group-item">Team: {{ $team_manage->name }}<br/>Role: {{ $team_manage->role }}<br/> <a href="/manage/team/{{ $team_manage->id }}">Team Page</a></li>
	@endforeach
	</ul>
@else
<p>You are currently not managing any teams</p>
@endif

@endsection