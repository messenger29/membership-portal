@extends('layouts.base')

@section('content')
<h1>{{$team->name}} Roster</h1>
<div class="well">
	<table class="table">
		<thead>
			<th>Name</th>
			<th>Notes</th>
		</thead>
		<tbody>
			@foreach($members as $member)
				<tr>
					<td>{{ $member['profile']->first_name }} {{ $member['profile']->last_name }}</td>
					<td>
						<span class="badge">Profile {{ $member['profile_flag'] }}</span> 
						<span class="badge">Waiver {{ $member['waiver_flag'] }}</span> 
						<span class="badge">Membership {{ $member['membership_flag'] }}</span>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection