<?php

/**
 * A vehicle that members of a group can book.
 *
 * @author Björn Hjortsten
 */
class Vehicle extends Eloquent {
	
	protected $table = 'vehicles';

	protected $softDelete = true;
	
	public $timestamps = false;
	
	public function createdBy() {
		return $this->belongsTo('User', 'created_by_id');
	}
	
	public function updatedBy() {
		return $this->belongsTo('User', 'updated_by_id');
	}
	
	public function group() {
		return $this->belongsTo('Group', 'group_id');
	}
	
	public function bookings() {
		return $this->hasMany('Booking', 'vehicle_id');
	}
}
