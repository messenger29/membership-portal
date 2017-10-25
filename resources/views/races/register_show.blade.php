@extends('layouts.base')

@section('content')
<h1>Registered for {{ $race_event->name }}</h1>
<p>Approved: {{ $race_reg->approved }}</p>
<p>Paid: {{ $race_reg->paid }}</p>
@foreach($race_crews as $crew)
	<div class="well">
		<h3>{{ $crew->name }}</h3>
		<p>Type: {{ $crew->crew_type }}</p>
		@if($crew->version)
			<p><a href="/race_manifest/{{ $crew->id }}/edit" class="btn btn-default">Edit Manifest</a></p>
		@else
			<p><a href="/race_manifest/{{ $crew->id }}/create" class="btn btn-default">Submit Manifest</a></p>
		@endif
	</div>
@endforeach
@endsection