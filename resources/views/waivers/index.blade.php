@extends('layouts.base')

@section('content')
<h1>Waivers</h1>
@if($fillCurrWaiver_flag)
	<div class="well">
		<h3>Please fill out <a href="/waivers/create">current waiver</a> for {{ $currentYear }}</h3>
	</div>
@endif

@if(count($waivers) > 0)
	@foreach($waivers as $waiver)
		<div class="well">
			<p>user_id: {{ $waiver->user_id }}</p>
			<p>waivertext_id: {{ $waiver->waivertext_id }}</p>
			<p>year: {{ $waiver->year }}</p>
			<p>submitted: {{ $waiver->created_at }}</p>
			<p><a href="waivers/{{$waiver->id}}">View Waiver</a></p>
		</div>
	@endforeach
@else
<p>No waivers in database</p>
@endif
@endsection