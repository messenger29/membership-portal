<div class="well">
	<h3>{{ $profile->last_name }}, {{ $profile->first_name }}{{ ' '.$profile->middle_initial }}</h3>
	<p><strong>Street:</strong> {{ $profile->street }}<br/>
		<strong>Street2:</strong> {{ $profile->street2 }}<br/>
		<strong>City:</strong> {{ $profile->city }}<br/>
		<strong>State:</strong> {{ $profile->state }}<br/>
		<strong>Zip:</strong> {{ $profile->zip }}<br/>
	</p>
	<p>
		<strong>Primary Phone:</strong> {{ $profile->phone_primary }}<br/>
		<strong>Alt Phone:</strong> {{ $profile->phone_alt }}
	</p>
	<p><strong>Birthday:</strong> {{ $profile->birthdate}} <br/>
		<strong>Gender:</strong> {{ $profile->gender }}<br/>
	</p>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="well">
			<h4>Emegency Contact #1</h4>
			<p><strong>Name:</strong> {{ $profile->emerg_name }}<br/>
				<strong>Relation: </strong> {{ $profile->emerg_relation }}<br/>
				<strong>Primary Phone:</strong> {{ $profile->emerg_phone_primary }}<br/>
				<strong>Alt Phone:</strong> {{ $profile->emerg_phone_alt }}
			</p>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="well">
			<h4>Emegency Contact #2</h4>
			<p><strong>Name:</strong> {{ $profile->emerg2_name }}<br/>
				<strong>Relation: </strong> {{ $profile->emerg2_relation }}<br/>
				<strong>Primary Phone:</strong> {{ $profile->emerg2_phone_primary }}<br/>
				<strong>Alt Phone:</strong> {{ $profile->emerg2_phone_alt }}
			</p>
		</div>
	</div>
</div>

<p>Last Updated: {{ $profile->updated_at }}</p>