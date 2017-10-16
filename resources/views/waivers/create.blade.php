@extends('layouts.base')

@section('content')
<p><a href="/waivers">Back to waivers</a></p>
<h1>{{ $waivertext->year }} Waiver</h1>
<div>
	<h2 class="text-center">{{ $waivertext->title }}</h2>
	<p class="text-center">{{ $waivertext->version }}</p>
	<p>{!! $waivertext->body !!}</p>
</div>

<div class="well">
	{!! Form::open(['action' => 'WaiversController@store', 'method' => 'POST']) !!}
		{{ FORM::hidden('youth_flag', $youth_flag) }}
		{{ FORM::hidden('waivertext_id', $waivertext->id) }}
		{{ FORM::hidden('year', $waivertext->year) }}
		<table class="table">
			<tbody>
				<tr>
					<td>{{ Form::checkbox('informedCodeConduct', '1') }}</td>
					<td>I have been informed about and offered material about Code of Conduct as it relates to participating role(s) I may be doing.</td>
				</tr>
				<tr>
					<td>{{ Form::checkbox('agreeCodeConduct', '1') }}</td>
					<td>I agree to abide by the Code of Conduct(s) as it relates to the role(s) I perform.</td>
				</tr>
				@if($youth_flag)
				<tr>
					<td>{{ Form::checkbox('youth_agree_flag', '1', null, ['required' => 'true']) }}</td>
					<td>I understand that members under the age of 18 require a parent/guardian signature. Please open the link to the right, print it, sign it, and obtain your parent's/guardian's signature. Return the signed form to your team membership coordinator. Download Youth Liability and Release Waiver</td>
				</tr>
				@endif
				<tr>
					<td colspan="2">
						<div class="row">
							<div class="col-sm-offset-3 col-sm-6">
								<div class="form-group">
						    	{{ Form::label('medical_notes','Enter Any Existing Medical Conditions Below') }}
						    	{{ Form::textarea('medical_notes', null, ['class' => 'form-control', 'placeholder' => '', 'rows' => '5']) }}
						    </div>
						  </div>
						</div>
					</td>
				</tr>
				<tr>
					<td>{{ Form::checkbox('agree_flag', '1', null, ['required' => 'true']) }}</td>
					<td>I have read and agree to the Liability Release and Waiver Agreement</td>
				</tr>
			</tbody>
		</table>
		<div class="row">
			<div class="col-md-3 col-sm-5 text-right">
				{{ Form::label('signature','Signature (Type Full Name)') }}
			</div>
			<div class="col-md-5 col-sm-7">
				<p>{{ Form::text('signature', null, ['class' => 'form-control', 'placeholder' => '', 'required' => 'true']) }}</p>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="row">
					<div class="col-xs-6 text-center">{{ FORM::submit('Submit', ['class' => 'btn btn-default btn-primary']) }}</div>
					<div class="col-xs-6 text-center"><a href="/waivers" class="btn btn-default btn-warning">Cancel</a></div>
				</div>
			</div>
		</div>
	{!! Form::close() !!}
</div>

@endsection