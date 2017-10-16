@extends('layouts.base')

@section('content')
<p><a href="/waivers">Back to waivers</a></p>
<h1>{{ $waivertext->year }} Waiver</h1>

<div class="well">
	<h2 class="text-center">{{ $waivertext->title }}</h2>
	<p class="text-center">{{ $waivertext->version }}</p>
	<p>{!! $waivertext->body !!}</p>
</div>
<p><strong>Medical Notes:</strong> {{ $waiver->medical_notes }}</p>
<p><strong>Signature:</strong> {{ $waiver->signature }} </p>
<p><strong>Signed: </strong> {{ $waiver->created_at }}</p>
@endsection