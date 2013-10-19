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
		$rules = array(
			'email' => 'required|email|unique:users|max:255',
			'password' => 'required|min:8|same:password-confirm',
			'name' => 'required',
			'alias' => 'required|max:255'
		);
		$messages = array(
			'required' => 'Fältet är obligatoriskt.',
			'email' => 'Ogiltig e-postadress.',
			'email.unique' => 'Ett konto med den angivna e-postadressen finns redan.',
			'max' => 'Fältet får inte innehålla fler än :max tecken.',
			'password.same' => 'Lösenorden stämmer inte överens.',
			'password.min' => 'Lösenordet måste innehålla minst :min tecken. '
		);
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()) {
			return Redirect::to('/sign-up')->withErrors($validator)
					->withInput(Input::except('password', 'password-confirm'));
		}
		
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
			return Redirect::to('/dashboard')->with('info', 'Du har loggat in.')->withInput(Input::only('email'));
        }
        
        // authentication failure! lets go back to the login page
        return Redirect::to('/')
            ->with('danger', '<strong>Felaktig inloggning!</strong><br>Ditt användarnamn och/eller lösenord var felaktigt. Var vänlig försök igen.')
            ->withInput();
	}
}
