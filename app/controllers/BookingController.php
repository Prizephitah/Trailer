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
	
	public function store($vehicleId) {
		$vehicle = Vehicle::find($vehicleId);
		if ($vehicle == null) {
			return App::abort(404, 'Fordonet finns inte');
		}
		
		$rules = array(
			'start.date' => 'required|date_format:Y-m-d',
			'end.date' => 'required|date_format:Y-m-d|end_date:start.date',
			'start.time' => array('required', 'regex:/([01]?[0-9]|2[0-3]):[0-5][0-9]/'),
			'end.time' => array('required', 'regex:/([01]?[0-9]|2[0-3]):[0-5][0-9]/')
		);
		$messages = array(
			'required' => 'Fältet är obligatoriskt.',
			'date_format' => 'Datumet måste vara på formatet ÅÅÅÅ-MM-DD.',
			'end_date' => 'Slutdatumet får inte vara före startdatumet.',
			'regex' => 'Klockslaget måste vara på formatet HH:MM.'
		);
		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()) {
			return Redirect::action('BookingController@create', array($vehicleId))
					->withErrors($validator)->withInput(Input::all());
		}
		if (Input::has('wholeday')) {
			$startDate = new DateTime(Input::get('start.date').' 00:00:00');
			$endDate = new DateTime(Input::get('end.date').' 23:59:59');
		} else {
			$startDate = new DateTime(Input::get('start.date').' '.Input::get('start.time'));
			$endDate = new DateTime(Input::get('end.date').' '.Input::get('end.time'));
		}
		if ($startDate > $endDate) {
			return Redirect::action('BookingController@create', array($vehicleId))
					->withErrors(array('end.time' => 'Sluttiden får inte vara före starttiden.'))
					->withInput(Input::all());
		}
		
		$booking = new Booking();
		$booking->user_id = Auth::user()->id;
		$booking->vehicle_id = $vehicleId;
		$booking->start = $startDate;
		$booking->end = $endDate;
		if (Input::has('comment')) {
			$booking->comment = Input::get('comment');
		}
		$booking->save();
		
		return Redirect::action('BookingController@show', array($booking->id))->with('success', 'Fordon bokat!');
	}
	
	public function show($bookingId) {
		$booking = Booking::find($bookingId);
		if ($booking == null) {
			return App::abort(404, 'Bokningen finns inte');
		}
		return View::make('booking/show')->with('booking', $booking)
				->with('title', 'Bokning av '.$booking->vehicle()->name);
	}
}
