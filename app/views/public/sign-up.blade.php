@extends('layout')

@section('content')
@include('public/navbar')
<div class="container">
	<form action="{{ url('/sign-up') }}" method="post">
		<div class="form-group">
			<label for="signup-email">E-postadress</label>
			<input type="email" name="email" id="signup-email" class="form-control" />
		</div>
		<div class="form-group">
			<label for="signup-password">Lösenord</label>
			<input type="password" name="password" id="signup-password" class="form-control" />
		</div>
		<div class="form-group">
			<label for="signup-password-confirm">Bekräfta lösenord</label>
			<input type="password" name="password-confirm" id="signup-password-confirm" class="form-control" />
		</div>
		<div class="form-group">
			<label for="signup-name">Fullständigt namn</label>
			<input type="text" name="name" id="signup-name" class="form-control" />
		</div>
		<div class="form-group">
			<label for="signup-alias">Vad vill du bli kallad?</label>
			<input type="text" name="alias" id="signup-alias" class="form-control" />
			<span class="help-block">Vad du normalt brukar kallas. Det måste inte vara något särskilt smeknamn utan bara vad du brukar kallas i vardagligt tal.</span>
		</div>
		
		<button type="submit" class="btn btn-success">Skapa konto</button>
	</form>
</div>
@stop
