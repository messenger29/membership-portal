@extends('layouts.base')

@section('content')
<h1>{{ $currentYear }} Membership Status</h1>

@if(!$waiver_status || !$profile_status)
	<div class="well">
		@if(!$profile_status)
			<p>Please fill out or confirm profile for {{ $currentYear }}.</p>
		@endif
		@if(!$waiver_status)
			<p>Please fill out waiver for {{ $currentYear }} first.</p>
		@endif
	</div>
@elseif(!$currentMembership)
	<div class="well alert-info">
		{!! Form::open(['action' => 'MembershipController@store', 'method' => 'POST']) !!}
		<div class="form-group">
			{{ Form::label('membership_type','Membership Type') }}
			{{ Form::select('membership_type', $membership_types_list, null, ['class' => 'form-control', 'placeholder' => '--Select--', 'required' => 'true']) }}
		</div>
		<p>{{ FORM::submit('Confirm '.$currentYear, ['class' => 'btn btn-default btn-primary']) }}</p>
		{!! Form::close() !!}
	</div>
@else
	<div class="well alert-info">
		<p>waiver_id: {{ $currentMembership->waiver_id }}</p>
		<p>profile_id: {{ $currentMembership->profile_id }}</p>
		<p>membership_type_id: {{ $currentMembership->membership_type_id }}</p>
		<p>year: {{ $currentMembership->year }}</p>
		<p>active: {{ $currentMembership->active }}</p>
		<p>paid: {{ $currentMembership->paid }}</p>
		<p>confirmed: {{ $currentMembership->updated_at }}</p>
	</div>
@endif

@if($memberships->count())
	<h3>Membership History</h3>
	<div class="row">
	@foreach($memberships as $membership)
		<div class="col-md-4 col-sm-6">
			<div class="well">
				<p>waiver_id: {{ $membership->waiver_id }}</p>
				<p>profile_id: {{ $membership->profile_id }}</p>
				<p>membership_type_id: {{ $membership->membership_type_id }}</p>
				<p>year: {{ $membership->year }}</p>
				<p>active: {{ $membership->active }}</p>
				<p>paid: {{ $membership->paid }}</p>
				<p>confirmed: {{ $membership->updated_at }}</p>
			</div>
		</div>
	@endforeach
	</div>
@endif

@endsection