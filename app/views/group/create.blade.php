@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	<div class="page-header">
		<h1>Skapa ny grupp</h1>
	</div>
	<form action="{{ action('GroupController@store') }}" method="post">
		
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<button type="submit" class="btn btn-success">Skapa</button>
	</form>
</div>
@stop
