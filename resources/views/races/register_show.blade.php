@extends('layouts.base')

@section('content')
<h1>Registered for {{ $race_event->name }}</h1>
<p>Approved: {{ $race_reg->approved }}</p>
<p>Paid: {{ $race_reg->paid }}</p>
@foreach($race_crews as $crew)
	<div class="well">
		<h3>{{ $crew->name }}</h3>
		<p>Type: {{ $crew->crew_type }}</p>
		<p><a class="btn btn-default" href="/race_manifest/{{ $crew->id }}/create">Submit Manifest</a></p>
	</div>
@endforeach
@endsection