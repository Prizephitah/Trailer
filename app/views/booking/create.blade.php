@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	@if(Session::has('danger'))
		<div class="alert alert-danger">{{ Session::get('danger') }}</div>
	@endif
	<div class="page-header">
		<h1>Boka {{{ $vehicle->name }}}</h1>
	</div>
	<form action="{{ action('BookingController@store', array($vehicle->id)) }}" method="post">
		<div class="row">
			<div class="col-md-2">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="wholeday" @if (Input::old('wholeday') != null) checked @endif id="wholeday" />
						Heldag
					</label>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group @if ($errors->has('start.date') || $errors->has('start.time')) has-error @endif">
					<label for="createbooking-from">Från</label>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<input type="date" class="form-control start-date" id="createbooking-from" 
									   name="start[date]" placeholder="Datum" value="{{{ Input::old('start.date') }}}" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar" rel="tooltip" title="Startdatum"></span>
								</span>
							</div>
							@foreach ($errors->get('start.date') as $error)
							@if ($error == '1') <?php continue; ?> @endif
							<span class="help-block">{{{ $error }}}</span>
							@endforeach
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<input type="time" class="form-control" name="start[time]" placeholder="Klockslag"
									   value="{{{ Input::old('start.time') }}}" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time" rel="tooltip" title="Starttid"></span>
								</span>
							</div>
							@foreach ($errors->get('start.time') as $error)
							<span class="help-block">{{{ $error }}}</span>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group @if ($errors->has('end.date') || $errors->has('end.time')) has-error @endif">
					<label for="createbooking-to">Till</label>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<input type="date" class="form-control end-date" id="createbooking-to" name="end[date]" 
									   placeholder="Datum" value="{{{ Input::old('end.date') }}}" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar" rel="tooltip" title="Slutdatum"></span>
								</span>
							</div>
							@foreach ($errors->get('end.date') as $error)
							@if ($error == '1') <?php continue; ?> @endif
							<span class="help-block">{{{ $error }}}</span>
							@endforeach
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<input type="time" class="form-control" name="end[time]" placeholder="Klockslag"
									   value="{{{ Input::old('end.time') }}}" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time" rel="tooltip" title="Sluttid"></span>
								</span>
							</div>
							@foreach ($errors->get('end.time') as $error)
							<span class="help-block">{{{ $error }}}</span>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-2">
				<div class="form-group">
					<label for="createbooking-comment">Notering</label>
					<textarea class="form-control" id="createbooking-comment" name="comment"
							  >{{{Input::old('comment')}}}</textarea>
				</div>
			</div>
		</div>
		@if (Session::has('conflictingBookings'))
		<div class="row">
			<div class="col-md-10 col-md-offset-2">
				<label>Krockande bokningar</label>
				<ul class="list-group">
					@foreach (Session::get('conflictingBookings') as $booking)
					<li class="list-group-item">
						<h4>
							<a href="{{ action('BookingController@show', array($booking->id)) }}">
							{{{ $booking->vehicle->name }}}
							</a>
							<small>
								{{ date('Y-m-d H:i', strtotime($booking->start)) }} &mdash; 
								{{ date('Y-m-d H:i', strtotime($booking->end)) }}
							</small>
						</h4>
						<dl>
							<dt>Bokad av</dt>
							<dd>{{{ $booking->user->name }}}</dd>
						</dl>
						@if ($booking->comment)
						<p>{{{ $booking->comment }}}</p>
						@endif
					</li>
					@endforeach
				</ul>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-md-10 col-md-offset-2">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<p><button type="submit" class="btn btn-success">Boka</button></p>
			</div>
		</div>
	</form>
</div>
@stop
