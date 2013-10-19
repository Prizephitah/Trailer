@extends('layout')

@section('content')
@include('public/navbar')
<div class="container">
	<h1>Skapa ett nytt konto</h1>
	<form action="{{ url('/sign-up') }}" method="post">
		<div class="form-group @if ($errors->has('email')) has-error @endif">
			<label for="signup-email">E-postadress</label>
			<input type="email" name="email" id="signup-email" class="form-control" value="{{{ Input::old('email') }}}"
				   tabindex="1"/>
			<?php
				foreach ($errors->get('email') as $error) {
					echo '<span class="help-block">'.$error.'</span>';
				}
			?>
		</div>
		<div class="form-group @if ($errors->has('password')) has-error @endif"">
			<label for="signup-password">Lösenord</label>
			<input type="password" name="password" id="signup-password" class="form-control" tabindex="2" />
			<?php
				foreach ($errors->get('password') as $error) {
					echo '<span class="help-block">'.$error.'</span>';
				}
			?>
		</div>
		<div class="form-group @if ($errors->has('password')) has-error @endif">
			<label for="signup-password-confirm">Bekräfta lösenord</label>
			<input type="password" name="password-confirm" id="signup-password-confirm" class="form-control" 
				   tabindex="3" />
		</div>
		<div class="form-group @if ($errors->has('name')) has-error @endif"">
			<label for="signup-name">Fullständigt namn</label>
			<input type="text" name="name" id="signup-name" class="form-control" value="{{{ Input::old('name') }}}" 
				   tabindex="4"/>
			<?php
				foreach ($errors->get('name') as $error) {
					echo '<span class="help-block">'.$error.'</span>';
				}
			?>
		</div>
		<div class="form-group @if ($errors->has('alias')) has-error @endif"">
			<label for="signup-alias">Vad vill du bli kallad?</label>
			<input type="text" name="alias" id="signup-alias" class="form-control" value="{{{ Input::old('alias') }}}" 
				   tabindex="5"/>
			<span class="help-block">Vad du normalt brukar kallas. Det måste inte vara något särskilt smeknamn utan bara vad du brukar kallas i vardagligt tal.</span>
			<?php
				foreach ($errors->get('alias') as $error) {
					echo '<span class="help-block">'.$error.'</span>';
				}
			?>
		</div>
		
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<button type="submit" class="btn btn-success" tabindex="6">Skapa</button>
	</form>
</div>
@stop
