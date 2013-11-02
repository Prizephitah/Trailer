<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) {
		$redirect = Redirect::guest('/login');
		if (Session::has('known_session')) {
			$redirect->with('warning', 'Inloggning krävs.');
		} else {
			Session::put('known_session', true);
		}
		return $redirect;
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/')->with('info', 'Du har blivit automatiskt inloggad.');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('groupadmin', function($route) {
	$id = $route->getParameter('group');
	if ($id === null) {
		$vehicleId = $route->getParameter('vehicle');
		$vehicle = Vehicle::find($vehicleId);
		if ($vehicle == null) {
			return App::abort(404, 'Resursen saknas');
		}
		$id = $vehicle->group->id;
	}
	$group = Group::with('users')->where('id', '=', $id)->first();
	if ($group == null) {
		return App::abort(404, 'Gruppen finns inte');
	}
	$isMember = $group->users->contains(Auth::user()->id);
	if (!$isMember || !(bool)$group->users->find(Auth::user()->id)->pivot->admin) {
		return Redirect::action('GroupController@show', array($group->id))
				->with('danger', 'Du saknar behörighet för att administrera gruppen!');
	}
});