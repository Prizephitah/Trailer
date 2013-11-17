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
		<h1>Bokning av {{{ $booking->vehicle->name }}} 
			<small>
				{{ date('Y-m-d H:i', strtotime($booking->start)) }} &mdash; 
				{{ date('Y-m-d H:i', strtotime($booking->end)) }}
			</small>
		</h1>
	</div>
	<div class="row">
		<div class="col-md-3">
			<dl>
				<dt>Bokad av</dt>
				<dd>{{{ $booking->user->name }}}</dd>
			</dl>
		</div>
		<div class="col-md-3">
			<dl>
				<dt>Från</dt>
				<dd>{{ date('Y-m-d H:i', strtotime($booking->start)) }}</dd>
			</dl>
		</div>
		<div class="col-md-3">
			<dl>
				<dt>Till</dt>
				<dd>{{ date('Y-m-d H:i', strtotime($booking->end)) }}</dd>
			</dl>
		</div>
		<div class="col-md-3">
			<dl>
				<dt>Tidsspann</dt>
				<?php
					$start = new DateTime($booking->start);
					$end = new DateTime($booking->end);
					$interval = $start->diff($end, true);
				?>
				<dd>
					@if ($interval->y > 0){{ $interval->y }} år @endif
					@if ($interval->m > 0){{ $interval->m }} @if ($interval->m > 1) månader @else månad @endif @endif
					@if ($interval->d > 0){{ $interval->d }} @if ($interval->d > 1) dagar @else dag @endif @endif
					@if ($interval->h > 0){{ $interval->h }} @if ($interval->h > 1) timmar @else timme @endif @endif
					@if ($interval->i > 0){{ $interval->i }} @if ($interval->i > 1) minuter @else minut @endif @endif
				</dd>
			</dl>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<dl>
				<dt>Fordon</dt>
				<dd>
					<a href="{{ action('VehicleController@show', array($booking->vehicle->id)) }}">
						{{{ $booking->vehicle->name }}} 
						@if ($booking->vehicle->license_plate)
							<small>({{{ $booking->vehicle->license_plate }}})</small>
						@endif
					</a>
				</dd>
			</dl>
		</div>
		<div class="col-md-3">
			<dl>
				<dt>Grupp</dt>
				<dd>
					<a href="{{ action('GroupController@show', array($booking->vehicle->group->id)) }}">
						{{{ $booking->vehicle->group->name }}}
					</a>
				</dd>
			</dl>
		</div>
	</div>
	@if (!empty($booking->comment))
	<div class="row">
		<div class="col-md-12">
			<h5><strong>Notering</strong></h5>
			<p>{{ nl2br(e($booking->comment)) }}</p>
		</div>
	</div>
	@endif
	@if ($isAdmin)
	<p>
		<button class="btn btn-primary"><span class="glyphicon glyphicon-cog"></span> Administrera</button>
	</p>
	@endif
</div>
@stop