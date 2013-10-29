<?php

/**
 * Handles Vehicles
 *
 * @author Björn Hjortsten
 */
class VehicleController extends BaseController {
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
		$this->beforeFilter('auth');
		$this->beforeFilter('groupadmin', array('except' => 'show'));
	}
	
	public function create($groupId) {
		return View::make('vehicle/create')->with('groupId', $groupId)->with('title', 'Lägg till nytt fordon');
	}
	
	public function store($groupId) {
		$rules = array(
			'name' => 'required|max:255',
			'license-plate' => 'max:255',
			'model-year' => 'date',
			'curb-weight' => 'integer|min:0',
			'gross-weight' => 'integer|min:0',
			'length' => 'integer|min:0',
			'width' => 'integer|min:0'
		);
		$messages = array(
			'required' => 'Fältet är obligatoriskt.',
			'max' => 'Fältet får inte innehålla fler än :max tecken.',
			'date' => 'Ogiltigt datum.',
			'integer' => 'Värdet måste vara ett heltal.',
			'min' => 'Värdet får inte vara negativt.'
		);
		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()) {
			return Redirect::action('VehicleController@create', array($groupId))
					->withErrors($validator)->withInput(Input::all());
		}
	}
}
