@extends('layout')

@section('content')
<div class="jumbotron">
	<div class="container">
		<h1>Fordonsbokning</h1>
		<div class="row">
			<div class="col-md-8">
				<p>
					Här kan du organisera och boka dina egna och vänners olika fordon för gemensam användning.
					Användare och fordon organiseras i grupper så att det är lätt att se vilka andra som kan boka ett fordon.
					Det är enkelt att skapa en grupp om det inte finns någon som passar just dig.
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
				@if(Session::has('warning'))
					<div class="alert alert-warning">{{ Session::get('warning') }}</div>
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
				använda utan kostnad. Systemet tillhandahålls helt utan någon garanti och driftsinformation finns inte 
				tillgänglig, men hjälp tas tacksamt emot.
			</p>
		</div>
		<div class="col-md-6">
			<h3>Källkod</h3>
			<p>
				Bokningssystemet är byggt på öppen källkod och bygger i grund och botten på 
				<a href="http://laravel.com">Laravel 4</a> med styling via <a href="http://getbootstrap.com/">Bootstrap 3</a>.
			</p>
			<p>
				Källkoden är finns publicerad på <a href="https://github.com/Prizephitah/trailer">GitHub</a>.
				<div class="github-widget" data-repo="Prizephitah/trailer"></div>
			</p>
		</div>
	</div>
</div>
@stop