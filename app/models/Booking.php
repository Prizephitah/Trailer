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
	
	public function updatedBy() {
		return $this->belongsTo('User', 'updated_by_id');
	}
	
	public function user() {
		return $this->belongsTo('User', 'user_id');
	}
	
	public function vehicle() {
		return $this->belongsTo('Vehicle', 'vehicle_id');
	}
}
