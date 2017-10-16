@if(isset($errors) && count($errors) > 0)
	@foreach($errors->all() as $error)
		<div class="alert alert-danger">
			<div class="container">{{ $error }}</div>
		</div>
	@endforeach
@endif

@if (session('status'))
  <div class="alert alert-info">
		<div class="container">{{ session('status') }}</div>
  </div>
@endif

@if(session('success'))
	<div class="alert alert-success">
		<div class="container">{{ session('success') }}</div>
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger">
		<div class="container">{{ session('error') }}</div>
	</div>
@endif

@if(isset($e) && $e->getMessage())
	<div class="alert alert-danger">
		<div class="container">{{ $e->getMessage() }}</div>
	</div>
@endif