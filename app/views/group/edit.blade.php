@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	@if(Session::has('danger'))
		<div class="alert alert-danger">{{ Session::get('danger') }}</div>
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
		<div class="form-group @if ($errors->has('description')) has-error @endif">
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