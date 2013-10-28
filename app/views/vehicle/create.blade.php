@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	<div class="page-header">
		<h1>Lägg till nytt fordon</h1>
	</div>
	<form action="{{ action('VehicleController@store', array($groupId)) }}" method="post">
		<div class="form-group">
			<label for="createvehicle-name">Namn</label>
			<input type="text" name="name" id="createvehicle-name" class="form-control" 
				   value="{{{ Input::old('name') }}}" />
		</div>
		<div class="form-group">
			<label for="createvehicle-licenseplate">Registreringsnummer</label>
			<input type="text" name="license-plate" id="createvehicle-licenseplate" class="form-control"
				   value="{{{ Input::old('license-plate') }}}" />
		</div>
		<div class="form-group">
			<label for="createvehicle-description">Beskrivning</label>
			<textarea name="description" id="createvehicle-description" class="form-control" cols="5"
					  >{{{ Input::old('description') }}}</textarea>
		</div>
		
		<input type="hidden" name="groupId" value="{{{ $groupId }}}" />
		<button class="btn btn-success" type="submit">Lägg till</button>
	</form>
</div>
