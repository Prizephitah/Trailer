@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	@if(Session::has('danger'))
		<div class="alert alert-danger">{{ Session::get('danger') }}</div>
	@endif
	@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
	@endif
	<div class="page-header">
		<h1>Administrera fordon <small>{{{ $vehicle->name }}}</small></h1>
	</div>
	<form action="{{ action('VehicleController@update', array($vehicle->id)) }}" method="post">
		<input type="hidden" name="_method" value="PUT" />
		
		<div class="form-group @if ($errors->has('name')) has-error @endif">
			<label for="editvehicle-name">Namn</label>
			<input type="text" name="name" id="editvehicle-name" class="form-control" tabindex="1"
				   value="{{{ Input::old('name', $vehicle->name) }}}" />
			@foreach ($errors->get('name') as $error)
			<span class="help-block">{{ $error }}</span>
			@endforeach
		</div>
		<div class="form-group @if ($errors->has('description')) has-error @endif">
			<label for="editvehicle-description">Beskrivning</label>
			<textarea name="description" id="editvehicle-description" class="form-control" cols="5" tabindex="2"
					  >{{{ Input::old('description', $vehicle->description) }}}</textarea>
			@foreach ($errors->get('description') as $error)
			<span class="help-block">{{ $error }}</span>
			@endforeach
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('license-plate')) has-error @endif">
					<label for="editvehicle-licenseplate">Registreringsnummer</label>
					<input type="text" name="license-plate" id="editvehicle-licenseplate" class="form-control"
						   value="{{{ Input::old('license-plate', $vehicle->license_plate) }}}" tabindex="3" />
					@foreach ($errors->get('license-plate') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('model-year')) has-error @endif">
					<label for="editvehicle-modelyear">Årsmodell</label>
					<select name="model-year" id="editvehicle-modelyear" class="form-control" tabindex="4" >
						<option value="" 
								@if (!Input::old('model-year', $vehicle->model_year)) selected @endif
								>Okänt</option>
						@for ($year = 1 + (int)date('Y'); $year >= 1900; $year--)
						<option 
							@if (Input::old('model-year', $vehicle->model_year) == $year) selected @endif
							>{{ $year }}</option>
						@endfor
					</select>
					@foreach ($errors->get('model-year') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('curb-weight')) has-error @endif">
					<label for="editvehicle-curbweight">Tjänstevikt</label>
					<div class="input-group">
						<input type="number" name="curb-weight" id="editvehicle-curbweight" class="form-control"
							   value="{{{ Input::old('curb-weight', $vehicle->curb_weight) }}}" tabindex="5" />
						<span class="input-group-addon">kg</span>
					</div>
					@foreach ($errors->get('curb-weight') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('gross-weight')) has-error @endif">
					<label for="editvehicle-grossweight">Totalvikt</label>
					<div class="input-group">
						<input type="number" name="gross-weight" id="editvehicle-grossweight" class="form-control"
							   value="{{{ Input::old('gross-weight', $vehicle->gross_weight) }}}" tabindex="6" />
						<span class="input-group-addon">kg</span>
					</div>
					@foreach ($errors->get('gross-weight') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('length')) has-error @endif">
					<label for="editvehicle-length">Längd</label>
					<div class="input-group">
						<input type="number" name="length" id="editvehicle-length" class="form-control"
							   value="{{{ Input::old('length', $vehicle->length) }}}" tabindex="7" />
						<span class="input-group-addon">cm</span>
					</div>
					@foreach ($errors->get('length') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('width')) has-error @endif">
					<label for="editvehicle-width">Bredd</label>
					<div class="input-group">
						<input type="number" name="width" id="editvehicle-width" class="form-control"
							   value="{{{ Input::old('width', $vehicle->width) }}}" tabindex="8" />
						<span class="input-group-addon">cm</span>
					</div>
					@foreach ($errors->get('width') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
		</div>
		
		<p>
			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token" />
			<button type="submit" class="btn btn-primary">Uppdatera</button>
			<button class="btn btn-danger delete-vehicle"
					data-href="{{ action('VehicleController@destroy', array($vehicle->id)) }}">
				<span class="glyphicon glyphicon-trash"></span> Ta bort
			</button>
		</p>
	</form>
</div>
@stop