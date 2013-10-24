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
		<h1>{{{ $group->name }}}</h1>
	</div>
	<p>{{ nl2br(e($group->description)) }}</p>
	<div class="row">
		<div class="col-md-6">
			<dl>
				<dt>Skapad</dt>
				<dd>{{ date('Y-m-d', strtotime($group->created)) }}</dd>
			</dl>
		</div>
		<div class="col-md-6">
			<dl>
				<dt>Skapad av</dt>
				<dd>
					@if ($isMember)
						{{{ $group->createdBy()->name }}}
					@else
						{{{ $group->createdBy()->alias }}}
					@endif
				</dd>
			</dl>
		</div>
	</div>
	@if ($group->updated)
	<div class="row">
		<div class="col-md-6">
			<dl>
				<dt>Uppdaterad</dt>
				<dd>{{ date('Y-m-d', strtotime($group->updated)) }}</dd>
			</dl>
		</div>
		<div class="col-md-6">
			<dl>
				<dt>Uppdaterad av</dt>
				<dd>
					@if ($isMember)
						{{{ $group->updatedBy()->name }}}
					@else
						{{{ $group->updatedBy()->alias }}}
					@endif
				</dd>
			</dl>
		</div>
	</div>
	@endif
	<div class="row">
	@if ($isMember)
		<div class="col-md-12">
			<h2>Medlemmar</h2>
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
					<td>@if ($user->pivot->admin) <span class="glyphicon glyphicon-ok-sign"></span> @endif</td>
				</tr>
				@endforeach
			</table>
		</div>
	@else
		<div class="col-md-6">
			<dl>
				<dt>Medlemmar</dt>
				<dd>{{ count($group->users) }}st.</dd>
			</dl>
		</div>
	@endif
	</div>
	<p>
		<div id="csrf-token">{{ csrf_token() }}</div>
	@if ($isAdmin)
		<button class="btn btn-primary admin-group" data-href="{{ action('GroupController@edit', array($group->id)) }}">
			<span class="glyphicon glyphicon-cog"></span> Administrera
		</button>
	@endif
	@if ($isMember)
		<button class="btn btn-warning leave-group"
				data-href="{{ action('GroupController@leave', array($group->id)) }}">Gå ur</button>
	@else
		<button class="btn btn-primary join-group" 
				data-href="{{ action('GroupController@join', array($group->id)) }}">Gå med</button>
	@endif
	</p>
</div>
@stop
