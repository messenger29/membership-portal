@extends('layouts.base')

@section('content')
<div class="container">
	<p><a href="/profiles">Back to profile</a></p>
	<h1>Edit Member Profile</h1>
	@include('profiles.profileform')
</div>

@endsection