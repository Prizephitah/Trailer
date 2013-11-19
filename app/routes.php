<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/login', array('before' => 'guest', 'do' => function() {
	return View::make('public/login')
			->with('title', 'Inloggning');
}));

Route::get('/sign-up', array('before' => 'guest', 'do' => function() {
	return View::make('public/sign-up')
			->with('title', 'Bli medlem');
}));

Route::post('/sign-up', 'SecurityController@signUp');

Route::post('/login', 'SecurityController@login');

Route::get('/logout', 'SecurityController@logout');

Route::get('/', array('before' => 'auth', 'do' => function() {
	$self = Auth::user();
	$self->load('groups');
	$bookings = DB::table('bookings')
			->select('bookings.id', 'bookings.start', 'bookings.end', 'vehicles.name as vehicle_name', 
					'users.name as user_name', 'bookings.comment')
			->join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
			->join('groups', 'vehicles.group_id', '=', 'groups.id')
			->join('groups_users', 'groups.id', '=', 'groups_users.group_id')
			->join('users', 'bookings.user_id', '=', 'users.id')
			->where('groups_users.user_id', '=', Auth::user()->id)
			->where('bookings.end', '>', new DateTime())
			->orderBy('bookings.start', 'asc')
			->get();
	$upcommingBookings = array();
	$ongoingBookings = array();
	foreach ($bookings as $booking) {
		if (new DateTime($booking->start) < new DateTime()) {
			$ongoingBookings[] = $booking;
		} else {
			$upcommingBookings[] = $booking;
		}
	}
	return View::make('dashboard', array(
		'title' => 'Kontrollpanel',
		'self' => $self,
		'upcommingBookings' => $upcommingBookings,
		'ongoingBookings' => $ongoingBookings
	));
}));

Route::resource('/group', 'GroupController');
Route::post('/group/{id}/join', 'GroupController@join');
Route::post('/group/{id}/leave', 'GroupController@leave');

Route::get('/group/{group}/add-vehicle', 'VehicleController@create');
Route::post('/group/{group}/add-vehicle', 'VehicleController@store');
Route::get('/vehicle/{vehicle}', 'VehicleController@show');
Route::get('/vehicle/{vehicle}/edit', 'VehicleController@edit');
Route::put('/vehicle/{vehicle}', 'VehicleController@update');
Route::delete('/vehicle/{vehicle}', 'VehicleController@destroy');

Route::get('/vehicle/{vehicle}/book', 'BookingController@create');
Route::post('/vehicle/{vehicle}/book', 'BookingController@store');
Route::get('/booking/{booking}', 'BookingController@show');
