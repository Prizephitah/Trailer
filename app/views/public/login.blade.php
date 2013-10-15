@extends('layout')

@section('content')
<form action="/login" method="post">
	<label for="login-email">E-postadress</label>
	<input type="text" name="email" id="login-email" />
	<label for="login-password">Lösenord</label>
	<input type="password" name="password" id="login-password" />
	
	<input type="submit" value="Logga in" />
</form>
@stop