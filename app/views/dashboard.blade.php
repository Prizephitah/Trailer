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
	<div class="row">
		<div class="col-md-6">
			<div class="page-header">
				<h2>
					Dina grupper
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default list-groups" 
								data-href="{{ action('GroupController@index') }}">Gå med i annan</button>
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ action('GroupController@create') }}">Skapa ny</a></li>
						</ul>
					</div>
				</h2>
			</div>
			<ul class="list-group">
				@foreach ($self->groups as $group)
				<li class="list-group-item">
					<h3><a href="{{ action('GroupController@show', array($group->id)) }}">
						{{{ $group->name }}}
					</a></h3>
					<p>{{{ $group->description }}}</p>
					<h4>Medlemmar</h4>
					<ul>
						@foreach ($group->users as $user)
						<li>{{{ $user->alias }}}</li>
						@endforeach
					</ul>
					<h4>Fordon</h4>
					<ul>
						@foreach ($group->vehicles as $vehicle)
						<li>
							<a href="{{ action('VehicleController@show', array($vehicle->id)) }}">
								{{{ $vehicle->name }}}
							</a> 
							@if ($vehicle->license_plate)
							<small>({{{ $vehicle->license_plate }}})</small>
							@endif
						</li>
						@endforeach
					</ul>
				</li>
				@endforeach
			</ul>
		</div>
		<div class="col-md-6">
			@if (!empty($ongoingBookings))
			<div class="page-header">
				<h2>Pågående bokningar</h2>
			</div>
			<ul class="list-group">
				@foreach ($ongoingBookings as $booking)
				<li class="list-group-item">
					<h3>
						<a href="{{ action('BookingController@show', array($booking->id)) }}">
						{{{ $booking->vehicle_name }}}
						</a>
						<small>
							{{ date('Y-m-d H:i', strtotime($booking->start)) }} &mdash; 
							{{ date('Y-m-d H:i', strtotime($booking->end)) }}
						</small>
					</h3>
					<dl>
						<dt>Bokad av</dt>
						<dd>{{{ $booking->user_name }}}</dd>
					</dl>
					@if ($booking->comment)
					<p>{{{ $booking->comment }}}</p>
					@endif
				</li>
				@endforeach
			</ul>
			@endif
			<div class="page-header">
				<h2>Kommande bokningar</h2>
			</div>
			<ul class="list-group">
				@foreach ($upcommingBookings as $booking)
				<li class="list-group-item">
					<h3>
						<a href="{{ action('BookingController@show', array($booking->id)) }}">
						{{{ $booking->vehicle_name }}}
						</a>
						<small>
							{{ date('Y-m-d H:i', strtotime($booking->start)) }} &mdash; 
							{{ date('Y-m-d H:i', strtotime($booking->end)) }}
						</small>
					</h3>
					<dl>
						<dt>Bokad av</dt>
						<dd>{{{ $booking->user_name }}}</dd>
					</dl>
					@if ($booking->comment)
					<p>{{{ $booking->comment }}}</p>
					@endif
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@stop

