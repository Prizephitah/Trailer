<?php

/**
 * A group of {@link User}s.
 * 
 * Defines which users who has access to wich vehicles.
 *
 * @author Björn Hjortsten
 */
class Group extends Eloquent {
	
	protected $table = 'groups';

	protected $softDelete = true;
	
	public $timestamps = false;
	
	public function createdBy() {
		return $this->belongsTo('User', 'created_by');
	}
	
	public function updatedBy() {
		return $this->belongsTo('User', 'updated_by');
	}
	
	public function users() {
		return $this->belongsToMany('User', 'groups_users')->withPivot('admin');
	}
	
}
