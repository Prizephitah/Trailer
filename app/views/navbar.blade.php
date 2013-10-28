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
				<li><a href="{{ url('/') }}">
					<span class="glyphicon glyphicon-dashboard visible-xs-inline"></span> Kontrollpanel
				</a></li>
				<li><a href="{{ action('GroupController@index') }}">
					<span class="glyphicon glyphicon-link visible-xs-inline"></span> Grupper
				</a></li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<li><p class="navbar-text">Inloggad som </p></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						{{{ Auth::user()->name }}} <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="{{ url('/profile') }}">Profil</a></li>
						<li><a href="{{ url('/logout') }}">Logga ut</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>