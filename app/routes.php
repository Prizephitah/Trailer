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

Route::get('/', function() {
	return View::make('public/login')
			->with('title', 'Inloggning');
});

Route::get('/sign-up', function() {
	return View::make('public/sign-up')
			->with('title', 'Bli medlem');
});

Route::post('/sign-up', 'SecurityController@signUp');