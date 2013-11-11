<?php

/**
 * Handles bookings
 *
 * @author Björn Hjortsten
 */
class BookingController extends BaseController {
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
		$this->beforeFilter('auth');
		$this->beforeFilter('groupmember');
	}
	
	public function create($vehicleId) {
		$vehicle = Vehicle::find($vehicleId);
		if ($vehicle == null) {
			return App::abort(404, 'Fordonet finns inte');
		}
		return View::make('booking/create')->with('vehicle', $vehicle)->with('title', 'Boka '.$vehicle->name);
	}
}
