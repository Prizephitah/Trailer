@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	<div class="page-header">
		<h1>Lägg till nytt fordon</h1>
	</div>
	<form action="{{ action('VehicleController@store', array($groupId)) }}" method="post">
		<div class="form-group @if ($errors->has('name')) has-error @endif">
			<label for="createvehicle-name">Namn</label>
			<input type="text" name="name" id="createvehicle-name" class="form-control" tabindex="1"
				   value="{{{ Input::old('name') }}}" />
			@foreach ($errors->get('name') as $error)
			<span class="help-block">{{ $error }}</span>
			@endforeach
		</div>
		<div class="form-group @if ($errors->has('description')) has-error @endif">
			<label for="createvehicle-description">Beskrivning</label>
			<textarea name="description" id="createvehicle-description" class="form-control" cols="5" tabindex="2"
					  >{{{ Input::old('description') }}}</textarea>
			@foreach ($errors->get('description') as $error)
			<span class="help-block">{{ $error }}</span>
			@endforeach
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('license-plate')) has-error @endif">
					<label for="createvehicle-licenseplate">Registreringsnummer</label>
					<input type="text" name="license-plate" id="createvehicle-licenseplate" class="form-control"
						   value="{{{ Input::old('license-plate') }}}" tabindex="3" />
					@foreach ($errors->get('license-plate') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('model-year')) has-error @endif">
					<label for="createvehicle-modelyear">Årsmodell</label>
					<select name="model-year" id="createvehicle-modelyear" class="form-control" tabindex="4" >
						<option value="" @if (empty(Input::old('model-year'))) selected @endif>Okänt</option>
						@for ($year = (int)date('Y'); $year >= 1900; $year--)
						<option @if (Input::old('model-year') == $year) selected @endif>{{ $year }}</option>
						@endfor
					</select>
					@foreach ($errors->get('model-year') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('curb-weight')) has-error @endif">
					<label for="createvehicle-curbweight">Tjänstevikt</label>
					<div class="input-group">
						<input type="number" name="curb-weight" id="createvehicle-curbweight" class="form-control"
							   value="{{{ Input::old('curb-weight') }}}" tabindex="5" />
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
					<label for="createvehicle-grossweight">Totalvikt</label>
					<div class="input-group">
						<input type="number" name="gross-weight" id="createvehicle-grossweight" class="form-control"
							   value="{{{ Input::old('gross-weight') }}}" tabindex="6" />
						<span class="input-group-addon">kg</span>
					</div>
					@foreach ($errors->get('gross-weight') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('legnth')) has-error @endif">
					<label for="createvehicle-length">Längd</label>
					<div class="input-group">
						<input type="number" name="legnth" id="createvehicle-length" class="form-control"
							   value="{{{ Input::old('length') }}}" tabindex="7" />
						<span class="input-group-addon">cm</span>
					</div>
					@foreach ($errors->get('length') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group @if ($errors->has('width')) has-error @endif">
					<label for="createvehicle-width">Bredd</label>
					<div class="input-group">
						<input type="number" name="width" id="createvehicle-width" class="form-control"
							   value="{{{ Input::old('width') }}}" tabindex="8" />
						<span class="input-group-addon">cm</span>
					</div>
					@foreach ($errors->get('width') as $error)
					<span class="help-block">{{ $error }}</span>
					@endforeach
				</div>
			</div>
		</div>
			
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<input type="hidden" name="groupId" value="{{{ $groupId }}}" />
		<button class="btn btn-success" type="submit" tabindex="9">Lägg till</button>
	</form>
</div>
