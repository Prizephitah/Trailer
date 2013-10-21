@extends('layout')

@section('content')
@include('navbar')
<div class="container">
	<div class="page-header">
		<h1>{{{ $group->name }}}</h1>
	</div>
	<p><?php echo nl2br(e($group->description)); ?></p>
	
	@if ($group->users->contains(Auth::user()->id))
	<h2>Medlemmar</h2>
	//Display members here
	@endif
</div>
@stop

