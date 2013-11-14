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
		return $this->belongsTo('User', 'created_by_id');
	}
	
	public function updatedBy() {
		return $this->belongsTo('User', 'updated_by_id');
	}
	
	public function users() {
		return $this->belongsToMany('User', 'groups_users')->withPivot('admin');
	}
	
	public function vehicles() {
		return $this->hasMany('Vehicle', 'group_id');
	}
	
}
