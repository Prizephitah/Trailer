@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	<div class="page-header">
		<h1>Skapa ny grupp</h1>
	</div>
	<form action="{{ action('GroupController@store') }}" method="post">
		<div class="form-group @if ($errors->has('name')) has-error @endif">
			<label for="creategroup-name">Namn</label>
			<input type="text" name="name" id="creategroup-name" class="form-control" value="{{{ Input::old('name') }}}"
				   tabindex="1"/>
			<?php
				foreach ($errors->get('name') as $error) {
					echo '<span class="help-block">'.$error.'</span>';
				}
			?>
		</div>
		<div class="form-group @if ($errors->has('description')) has-error @endif">
			<label for="creategroup-description">Beskrivning</label>
			<textarea name="description" id="creategroup-description" class="form-control" tabindex="2" cols="5"
					  >{{{ Input::old('description') }}}</textarea>
			<?php
				foreach ($errors->get('description') as $error) {
					echo '<span class="help-block">'.$error.'</span>';
				}
			?>
		</div>
		
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<button type="submit" class="btn btn-success">Skapa</button>
	</form>
</div>
@stop
