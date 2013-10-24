@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	<div class="page-header">
		<h1>Gå med i befintlig grupp</h1>
	</div>
	<div id="csrf-token">{{ csrf_token() }}</div>
	<ul class="list-group">
		@foreach ($groups as $group)
		<li class="list-group-item">
			<h3><a href="{{ action('GroupController@show', array($group->id)) }}">
						{{{ $group->name }}}
			</a></h3>
			<p>{{{ $group->description }}}</p>
			<div class="row">
				<div class="col-md-4">
					<dl>
						<dt>Skapad</dt>
						<dd>{{ date('Y-m-d', strtotime($group->created)) }}</dd>
					</dl>
				</div>
				<div class="col-md-4">
					<dl>
						<dt>Skapad av</dt>
						<dd>{{ $group->createdBy()->alias }}</dd>
					</dl>
				</div>
				<div class="col-md-4">
					<dl>
						<dt>Medlemmar</dt>
						<dd>{{ count($group->users) }}st.</dd>
					</dl>
				</div>
			</div>
			<div class="pull-right">
				@if ($group->users->contains(Auth::user()->id))
				<button class="btn btn-warning leave-group"
						data-href="{{ action('GroupController@leave', array($group->id)) }}">Gå ur</button>
				@else
				<button class="btn btn-primary join-group" 
						data-href="{{ action('GroupController@join', array($group->id)) }}">Gå med</button>
				@endif
			</div>
			<div class="clearfix"></div>
		</li>
		@endforeach
	</ul>
	<h4>Hittade du ingen passande grupp?</h4>
	<p>
		Om ingen av de befintliga grupperna passar går det alltid att skapa en helt ny!<br />
	</p>
	<p><button class="btn btn-success create-group" data-href="{{ action('GroupController@create') }}">Skapa ny grupp</button></p>
</div>
@stop