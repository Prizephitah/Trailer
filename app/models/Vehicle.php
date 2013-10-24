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
		return User::find($this->created_by);
	}
	
	public function updatedBy() {
		return User::find($this->updated_by);
	}
	
	public function group() {
		$this->belongsTo('Group', 'group_id');
	}
}
