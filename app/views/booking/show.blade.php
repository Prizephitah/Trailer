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
	
</div>
@stop