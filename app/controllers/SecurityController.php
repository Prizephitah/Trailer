<?php

/**
 * Handles user registration and authentication.
 *
 * @author Björn Hjortsten
 */
class SecurityController extends BaseController {
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
	}
	
	public function signUp() {
		$user = new User();
		$user->email = strtolower(Input::get('email'));
		$user->password = Hash::make(Input::get('password'));
		$user->name = Input::get('name');
		$user->alias = Input::get('alias');
		$user->created = new DateTime();
		$user->save();
		
		return Redirect::to('/')->with('success', '<strong>Konto skapat!</strong> Du kan nu logga in.');
	}
}
