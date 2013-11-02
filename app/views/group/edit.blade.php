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
		<h1>Administrera grupp <small>{{{ $group->name }}}</small></h1>
	</div>
	<form action="{{ action('GroupController@update', array($group->id)) }}" method="post">
		<input type="hidden" name="_method" value="PUT" />
		
		<div class="form-group @if ($errors->has('name')) has-error @endif">
			<label for="editgroup-name">Namn</label>
			<input type="text" name="name" id="editgroup-name" class="form-control" 
				   value="{{{ Input::old('name', $group->name) }}}" tabindex="1"/>
			@foreach ($errors->get('name') as $error)
				<span class="help-block">{{ $error }}</span>
			@endforeach
		</div>
		<div class="form-group @if ($errors->has('description')) has-error @endif">
			<label for="editgroup-description">Beskrivning</label>
			<textarea name="description" id="editgroup-description" class="form-control" tabindex="2" cols="5"
					  >{{{ Input::old('description', $group->description) }}}</textarea>
			@foreach ($errors->get('description') as $error)
				<span class="help-block">{{ $error }}</span>
			@endforeach
		</div>
		<div class="form-group @if ($errors->has('users')) has-error @endif">
			<label>Behörigheter</label>
			<table class="table table-hover">
				<tr>
					<th>Namn</th>
					<th class="hidden-xs">Kortnamn</th>
					<th>E-postadress</th>
					<th>Administratör</th>
				</tr>
				@foreach ($group->users as $user)
				<tr>
					<td>{{{ $user->name }}}</td>
					<td class="hidden-xs">{{{ $user->alias }}}</td>
					<td>{{{ $user->email }}}</td>
					<td>
						<input type="hidden" name="admins[{{ $user->id }}][dummy]" value="dummy" />
						<input type="checkbox" name="admins[{{ $user->id }}][admin]" @if ($user->pivot->admin) checked @endif />
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		<div class="form-group clearfix">
			<label>Fordon</label>
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th>Namn</th>
						<th>Registreringsnummer</th>
						<th>Årsmodell</th>
						<th>Tjänstevikt/Totalvikt (kg)</th>
						<th>Längd/Bredd (cm)</th>
						<th></th>
					</tr>
					@foreach ($group->vehicles as $vehicle)
					<tr data-id="{{ $vehicle->id }}">
						<td>{{{ $vehicle->name }}}</td>
						<td>{{{ $vehicle->license_plate }}}</td>
						<td>{{{ date('Y', strtotime($vehicle->model_year)) }}}</td>
						<td>{{{ $vehicle->curb_weight }}}/{{{ $vehicle->gross_weight }}}</td>
						<td>{{{ $vehicle->length }}}/{{{ $vehicle->width }}}</td>
						<td><button class="btn btn-primary pull-right edit-vehicle" 
									data-href="{{ action('VehicleController@edit', array($vehicle->id)) }}">
								<span class="glyphicon glyphicon-cog"></span> Administrera</button>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
			<button class="btn btn-success pull-right add-vehicle-group" 
					data-href="{{ action('VehicleController@create', array($group->id)) }}">
				Lägg till nytt fordon
			</button>
		</div>
		
		<p>
			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token" />
			<button type="submit" class="btn btn-primary" tabindex="3">Uppdatera</button>
			<button class="btn btn-danger delete-group" tabindex="4" 
					data-href="{{ action('GroupController@destroy', array($group->id)) }}">
				Ta bort
			</button>
		</p>
	</form>
</div>
@stop