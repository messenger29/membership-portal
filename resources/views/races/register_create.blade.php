@extends('layouts.base')

@section('content')
<h1>{{ $race_event->name}} - Registration</h1>
<div class="well">
	<p>Team Name: {{ $team->name }}</p>
</div>
<div class="well">
	<div class="row">
		<div class="col-md-12">{{ $race_event->body }}</div>
	</div>
</div>
<div class="well">
	{{ Form::open(['action' => ['RaceController@register_store', $race_event->id]]) }}
	{{ Form::hidden('team_id', $team->id) }}
	{{ Form::hidden('race_event_id', $race_event->id) }}
	<div id="crew_section">
		<div id="crew_1" class="crew_row">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
				  	{{ Form::label('name','Crew Name') }}
				  	{{ Form::text('name[]', null, ['class' => 'form-control', 'placeholder' => 'Crew Name', 'required' => 'true']) }}
				  </div>	
				 </div>
			</div>
			<div class="row">
				<div class="col-sm-6">
				  <div class="form-group">
						{{ Form::label('crew_type','Crew Type') }}
						{{ Form::select('crew_type[]', ['mixed' => 'Mixed', 'open' => 'Open', 'women' => 'Women', 'masters' => 'Masters'], null, ['class' => 'form-control', 'placeholder' => '--Select--', 'required' => 'true']) }}
						{{ Form::label('partners','If partnering with another team, please state other team name(s):') }}
				  	{{ Form::text('partners[]', null, ['class' => 'form-control', 'placeholder' => 'Team Name(s)']) }}
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						{{ Form::label('crew_rank', 'Crew Rank By Type') }}
						{{ Form::select('crew_rank[]', [1,2,3,4,5], null, ['class' => 'form-control', 'placeholder' => '--Select--'])}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
				  	{{ Form::label('notes','Notes') }}
				  	{{ Form::textarea('notes[]', null, ['class' => 'form-control', 'rows' => 5]) }}
				  </div>	
				</div>
			</div>
			<div class="row text-right">
				<div class="col-md-12">
					<button type="button" class="remove_crew"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				</div>
			</div>
			<hr>
		</div> <!-- /crew_row -->
	</div><!-- //crew_section -->
</div>
<div id="add_more_section" class="well text-center">
	<button id="addMoreCrew" type="button">Add More Crews</button>
</div>
<div class="well">
	{{ Form::submit('Register', ['class' => 'btn btn-default btn-primary']) }}</p>
	{{ Form::close() }}
</div>
<script type="text/javascript">
	$('.remove_crew').hide();

	$(document).ready(function(){
		$('#addMoreCrew').click(function(){
			$('.crew_row').first().clone().find("input").val("").end().find("textarea").val("").end().find('select option:first-child()').attr('selected','selected').end().attr("id", "").appendTo('#crew_section');

			if($('.crew_row').length >= 3){
				$("#add_more_section").hide();
			}

			if($('.crew_row').length > 1){
				$('.remove_crew').show();
			}
		});

		$(document).on('click', '.remove_crew', function(){
			if(confirm('Are you sure you want to delete crew?')){
				$(this).parent().parent().parent().remove();
			}

			if($('.crew_row').length == 1){
				$('.remove_crew').hide();
			}

			if($('.crew_row').length < 3){
				$("#add_more_section").show();
			}
		});
	});

</script>
@endsection