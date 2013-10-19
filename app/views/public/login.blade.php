@extends('layout')

@section('content')
<div class="jumbotron">
	<div class="container">
		<h1>Fordonsbokning</h1>
		<div class="row">
			<div class="col-md-8">
				<p>
					Här kan du organisera och boka dina gruppers olika gemensamma fordon.
				</p>
				<p>
					<a href="{{ url('/sign-up') }}">Skapa</a> ditt konto nu!
				</p>
			</div>
			<div class="col-md-4">
				@if(Session::has('success'))
					<div class="alert alert-success">{{ Session::get('success') }}</div>
				@endif
				@if(Session::has('danger'))
					<div class="alert alert-danger">{{ Session::get('danger') }}</div>
				@endif
				<form action="{{ url('/login') }}" method="post">
					<div class="form-group">
						<label for="login-email">E-postadress</label>
						<input type="email" name="email" id="login-email" class="form-control" 
							   placeholder="E-postadress" value="{{{ Input::old('email') }}}" tabindex="1" />
					</div>
					<div class="form-group">
						<label for="login-password">Lösenord</label>
						<input type="password" name="password" id="login-password" class="form-control" 
							   placeholder="Lösenord" tabindex="2" />
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember-me" tabindex="3" /> Kom ihåg mig
						</label>
					</div>

					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<button type="submit" class="btn btn-primary" tabindex="4">Logga in</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h3>Tillgänglighet</h3>
			<p>
				Bokningssystemet är öppet för alla privatpersoner samt icke vinstdrivande organisationer att 
				använda utan kostnad.
			</p>
		</div>
		<div class="col-md-6">
			<h3>Källkod</h3>
			<p>Bokningssystemet är byggt på öppen källkod och bygger i grund och botten på Laravel 4.</p>
		</div>
	</div>
</div>
@stop