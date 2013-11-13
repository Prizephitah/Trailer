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
	return View::make('dashboard', array(
		'title' => 'Kontrollpanel',
		'self' => $self
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