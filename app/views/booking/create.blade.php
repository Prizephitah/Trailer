@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	<div class="page-header">
		<h1>Boka {{{ $vehicle->name }}}</h1>
	</div>
	<form action="" method="post">
		<div class="row">
			<div class="col-md-2">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="wholeday" id="wholeday" />
						Heldag
					</label>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label for="createbooking-from">Från</label>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<input type="date" class="form-control start-date" id="createbooking-from" 
									   name="start[date]" placeholder="Datum"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar" rel="tooltip" title="Startdatum"></span>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<input type="time" class="form-control" name="start[time]" placeholder="Klockslag" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time" rel="tooltip" title="Starttid"></span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label for="createbooking-to">Till</label>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<input type="date" class="form-control end-date" id="createbooking-to" name="end[date]" 
									   placeholder="Datum"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar" rel="tooltip" title="Slutdatum"></span>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<input type="time" class="form-control" name="end[time]" placeholder="Klockslag"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-time" rel="tooltip" title="Sluttid"></span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-2">
				<div class="form-group">
					<label for="createbooking-comment">Notering</label>
					<textarea class="form-control" id="createbooking-comment" name="comment"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-2">
				<p><button type="submit" class="btn btn-success">Boka</button></p>
			</div>
		</div>
	</form>
</div>
@stop
