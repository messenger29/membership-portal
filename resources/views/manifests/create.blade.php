@extends('layouts.base')

@section('content')
<p><a href="/race_registration/{{$race_reg->id}}">Back to race registration page</a></p>
<h1>Race Manifest: {{ $race_crew->name }}</h1>
<p>Team: {{ $team->name }}</p>
<p>Race: {{ $race_event->name }}</p>
{{ Form::open(['action' => ['ManifestsController@store', $race_crew->id], 'method' => 'POST']) }}
<div class="well">
	<ul style="font-size: 18px;">
		@foreach($roster as $member)
			@if($member->rostered == -1)
				<li>{{ $member->name }}</li>
			@else
				<li>{{ Form::checkbox('members[]', $member->id, null, []) }} {{ $member->name }}</li>
			@endif
		@endforeach
	</ul>
</div>
<p>{{ FORM::submit('Submit', ['class' => 'btn btn-default btn-primary']) }}</p>
{{ Form::close() }}
@endsection