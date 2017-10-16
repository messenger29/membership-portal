@if(isset($profile_edit_flag) && $profile_edit_flag == 1)
{!! Form::model($profile, ['route' => ['profiles.update', $profile->id], 'method'=> 'PUT']) !!}
@else
{!! Form::open(['action' => 'ProfilesController@store', 'method' => 'POST']) !!}
@endif


	<!--NAME-->
	<div class="row">
		<div class="col-sm-5 col-xs-8">
	    <div class="form-group">
	    	{{ Form::label('first_name','First Name') }}
	    	{{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name', 'required' => 'true']) }}
	    </div>
	  </div>
		<div class="col-sm-2 col-xs-4">
	    <div class="form-group">
	    	{{ Form::label('middle_initial','M.I.') }}
	    	{{ Form::text('middle_initial', null, ['class' => 'form-control', 'placeholder' => 'MI']) }}
	    </div>
	  </div>
	  <div class="col-sm-5">
	    <div class="form-group">
	    	{{ Form::label('last_name','Last Name') }}
	    	{{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name', 'required' => 'true']) }}
	    </div>
	  </div>
	</div>
	<hr>
	<!--ADDRESS-->
	<div class="row">
	 	<div class="col-sm-8">
	 		<div class="form-group">
	    	{{ Form::label('street','Address 1') }}
	    	{{ Form::text('street', null, ['class' => 'form-control', 'placeholder' => '123 Main St.', 'required' => 'true']) }}
	    </div>
	 	</div>
	 	<div class="col-sm-4">
	 		<div class="form-group">
	    	{{ Form::label('street2','Address 2') }}
	    	{{ Form::text('street2', null, ['class' => 'form-control', 'placeholder' => '123']) }}
	    </div>
	 	</div>
	</div>
	<div class="row">
	 	<div class="col-sm-6">
	 		<div class="form-group">
	    	{{ Form::label('city','City') }}
	    	{{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City', 'required' => 'true']) }}
	    </div>
	 	</div>
	 		<div class="col-sm-2 col-xs-4">
	 		<div class="form-group">
	    	{{ Form::label('state','State') }}
	    	{{ Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'State', 'required' => 'true']) }}
	    </div>
	 	</div>
	 	<div class="col-sm-4 col-xs-8">
	 		<div class="form-group">
	    	{{ Form::label('zip','Zip Code') }}
	    	{{ Form::text('zip', null, ['class' => 'form-control', 'placeholder' => '12345', 'required' => 'true']) }}
	    </div>
	 	</div>
	</div>
	<hr>
	<!-- PHONE -->
	<div class="row">
	 	<div class="col-sm-6">
	 		<div class="form-group">
	    	{{ Form::label('phone_primary','Primary Phone') }}
	    	{{ Form::text('phone_primary', null, ['class' => 'form-control', 'placeholder' => '123-456-7890', 'required' => 'true']) }}
	    </div>
	 	</div>
	 	<div class="col-sm-6">
	 		<div class="form-group">
	    	{{ Form::label('phone_alt','Alternate Phone') }}
	    	{{ Form::text('phone_alt', null, ['class' => 'form-control', 'placeholder' => '123-456-7890']) }}
	    </div>
	 	</div>
	</div>
	<hr/>
	<!-- AGE/GENDER -->
	<div class="row">
		<div class="col-xs-6">
			<div class="form-group">
				{{ Form::label('birthdate','Birthdate') }}
				@if(isset($profile_edit_flag))
				<p>{{ $profile->birthdate }}</p>
				@else
				{{ Form::date('birthdate', null, ['class' => 'form-control', 'required' => 'true']) }}
				@endif
			</div>
		</div>
		<div class="col-xs-6">
			<div class="form-group">
				{{ Form::label('gender','Gender') }}
				{{ Form::select('gender', ['F' => 'Female', 'M' => 'Male', 'D' => 'Declined to state'], null, ['class' => 'form-control', 'placeholder' => '--Select--', 'required' => 'true']) }}
			</div>
		</div>
	</div>
	<hr>
	<!-- EMERGENCY CONTACY -->
	<h2>Emergency Contact Information</h2>
	<p>Emergency contact person(s) should not be a fellow paddler in case that person is also involved in the same emergency</p>
	<h3>Emegency Contact #1</h3>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				{{ Form::label('emerg_name', 'Contact #1 Name') }}
				{{ Form::text('emerg_name', null, ['class' => 'form-control', 'placeholder' => 'Full Name', 'required' => 'true']) }}
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				{{ Form::label('emerg_relation', 'Contact #1 Relationship') }}
				{{ Form::text('emerg_relation', null, ['class' => 'form-control', 'placeholder' => 'Father, sister, cousin, friend, etc...', 'required' => 'true']) }}
			</div>
		</div>
	</div>
	<div class="row">
	 	<div class="col-sm-6">
	 		<div class="form-group">
	    	{{ Form::label('emerg_phone_primary','Contact #1 Primary Phone') }}
	    	{{ Form::text('emerg_phone_primary', null, ['class' => 'form-control', 'placeholder' => '123-456-7890', 'required' => 'true']) }}
	    </div>
	 	</div>
	 	<div class="col-sm-6">
	 		<div class="form-group">
	    	{{ Form::label('emerg_phone_alt','Contact #1 Alternate Phone') }}
	    	{{ Form::text('emerg_phone_alt', null, ['class' => 'form-control', 'placeholder' => '123-456-7890']) }}
	    </div>
	 	</div>
	</div>
	<h3>Emegency Contact #2</h3>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				{{ Form::label('emerg2_name', 'Contact #2 Name') }}
				{{ Form::text('emerg2_name', null, ['class' => 'form-control', 'placeholder' => 'Full Name']) }}
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				{{ Form::label('emerg2_relation', 'Contact #2 Relationship') }}
				{{ Form::text('emerg2_relation', null, ['class' => 'form-control', 'placeholder' => 'Father, sister, cousin, friend, etc...']) }}
			</div>
		</div>
	</div>
	<div class="row">
	 	<div class="col-sm-6">
	 		<div class="form-group">
	    	{{ Form::label('emerg2_phone_primary','Contact #2 Primary Phone') }}
	    	{{ Form::text('emerg2_phone_primary', null, ['class' => 'form-control', 'placeholder' => '123-456-7890']) }}
	    </div>
	 	</div>
	 	<div class="col-sm-6">
	 		<div class="form-group">
	    	{{ Form::label('emerg2_phone_alt','Contact #2 Alternate Phone') }}
	    	{{ Form::text('emerg2_phone_alt', null, ['class' => 'form-control', 'placeholder' => '123-456-7890']) }}
	    </div>
	 	</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-6 text-center">
			<p>{{ FORM::submit('Save', ['class' => 'btn btn-default btn-primary']) }}</p>
		</div>
		<div class="col-xs-6 text-center">
			<p><a href="/profiles" class="btn btn-default btn-warning">Cancel</a></p>
		</div>
	</div>
{!! Form::close() !!}