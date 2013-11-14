@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
	@endif
	@if(Session::has('danger'))
		<div class="alert alert-danger">{{ Session::get('danger') }}</div>
	@endif
	@if(Session::has('info'))
		<div class="alert alert-info">{{ Session::get('info') }}</div>
	@endif
				
	<div class="page-header">
		<h1>{{{ $vehicle->name }}} 
			<small>Grupp: <a href="{{ action('GroupController@show', array($vehicle->group->id)) }}">
				{{{ $vehicle->group->name }}}
			</a></small>
		</h1>
	</div>
	<p>{{ nl2br(e($vehicle->description)) }}</p>
	<div class="row">
		<div class="col-md-4">
			<dl>
				<dt>Skapad</dt>
				<dd>{{ date('Y-m-d', strtotime($vehicle->created)) }}</dd>
			</dl>
		</div>
		<div class="col-md-8">
			<dl>
				<dt>Skapad av</dt>
				<dd>
					@if ($isMember)
						{{{ $vehicle->createdBy->name }}}
					@else
						{{{ $vehicle->createdBy->alias }}}
					@endif
				</dd>
			</dl>
		</div>
	</div>
	@if ($vehicle->updated)
	<div class="row">
		<div class="col-md-4">
			<dl>
				<dt>Uppdaterad</dt>
				<dd>{{ date('Y-m-d', strtotime($vehicle->updated)) }}</dd>
			</dl>
		</div>
		<div class="col-md-8">
			<dl>
				<dt>Uppdaterad av</dt>
				<dd>
					@if ($isMember)
						{{{ $vehicle->updatedBy->name }}}
					@else
						{{{ $vehicle->updatedBy->alias }}}
					@endif
				</dd>
			</dl>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-4">
			<dl>
				<dt>Registreringsnummer</dt>
				<dl>{{{ $vehicle->license_plate }}}</dl>
			</dl>
		</div>
		<div class="col-md-4">
			<dl>
				<dt>Årsmodell</dt>
				<dl>{{{ $vehicle->model_year ? date('Y', strtotime($vehicle->model_year)) : 'Okänt' }}}</dl>
			</dl>
		</div>
		<div class="col-md-4">
			<dl>
				<dt>Tjänstevikt</dt>
				<dl>{{{ $vehicle->curb_weight }}}kg</dl>
			</dl>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<dl>
				<dt>Totalvikt</dt>
				<dl>{{{ $vehicle->gross_weight }}}kg</dl>
			</dl>
		</div>
		<div class="col-md-4">
			<dl>
				<dt>Längd</dt>
				<dl>{{{ $vehicle->length }}}cm</dl>
			</dl>
		</div>
		<div class="col-md-4">
			<dl>
				<dt>Bredd</dt>
				<dl>{{{ $vehicle->width }}}cm</dl>
			</dl>
		</div>
	</div>
	@if ($isMember)
	<p>
		@if ($isAdmin)
		<button class="btn btn-primary admin-vehicle" 
				data-href="{{ action('VehicleController@edit', array($vehicle->id)) }}">
			<span class="glyphicon glyphicon-cog"></span> Administrera
		</button>
		@endif
		<!--<button class="btn btn-primary">Boka</button>-->
	</p>
	@endif
@stop
