<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ $title }} - Bokning</title>
		@stylesheets('application')
		@javascripts('application')
		<link href="{{ asset('assets/fonts/fonts.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body>
		@yield('content')
	</body>
</html>
