<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Visa meny</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			<a class="navbar-brand" href="{{ url('/') }}">Fordonsbokning</a>
		</div>
		
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ url('/') }}">Kontrollpanel</a></li>
				<li><a href="{{ action('GroupController@index') }}">Grupper</a></li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li><p class="navbar-text">
					Inloggad som <a href="{{ url('/profile') }}" class="navbar-link">{{{ Auth::user()->name }}}</a>
				</p></li>
			</ul>
		</div>
	</div>
</nav>