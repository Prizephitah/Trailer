<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('/') }}">Fordonsbokning</a>
		</div>
		
		<div class="navbar-right">
			<p class="navbar-text pull-right">
				Inloggad som <a href="{{ url('/profile') }}" class="navbar-link">{{{ Auth::user()->name }}}</a>
			</p>
		</div>
	</div>
</nav>