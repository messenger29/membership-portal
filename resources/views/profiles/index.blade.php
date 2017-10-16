@extends('layouts.base')

@section('content')
<h1>Your Member Profile</h1>
@if(isset($profile) && $profile)
	<p>
		<a class="btn btn-default" href="/profiles/{{$profile->id}}/edit">Edit Profile</a>
	@if($confirm_current_year_flag)
		<a href="/profiles/{{$profile->id}}/confirm" class="btn btn-success">Confirm Profile for {{ $currentYear }}</a>
	@endif
	</p>
	@include('profiles.profileshow')
@else
	<p><a class="btn btn-default" href="/profiles/create">Create Profile</a></p>
@endif
@endsection