@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	<div class="page-header">
		<h1>Administrera grupp <small>{{{ $group->name }}}</small></h1>
	</div>
	<form action="{{ action('GroupController@edit', array($group->id)) }}">
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
		
		<p>
			<button type="submit" class="btn btn-primary" tabindex="3">Uppdatera</button>
			<button class="btn btn-danger delete-group" tabindex="4">Ta bort</button>
		</p>
	</form>
</div>
@stop