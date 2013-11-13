<?php

/**
 * Represents a booking
 *
 * @author Björn Hjortsten
 */
class Booking extends Eloquent {
	
	protected $table = 'bookings';

	protected $softDelete = true;
	
	public $timestamps = false;
	
	public function createdBy() {
		return User::find($this->created_by);
	}
	
	public function updatedBy() {
		return User::find($this->updated_by);
	}
	
	public function user() {
		return User::find($this->user_id);
	}
	
	public function vehicle() {
		return Vehicle::find($this->vehicle_id);
	}
}
