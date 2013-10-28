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
		
	}
}
