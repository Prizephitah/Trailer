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
	
	public function login() {
		$user = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		);
		
		if (Auth::attempt($user, Input::has('remember-me'))) {
			return Redirect::to('/dashboard')->with('info', 'Du har loggat in.');
        }
        
        // authentication failure! lets go back to the login page
        return Redirect::to('/')
            ->with('danger', '<strong>Felaktig inloggning!</strong><br>Ditt användarnamn och/eller lösenord var felaktigt. Var vänlig försök igen.')
            ->withInput();
	}
}
