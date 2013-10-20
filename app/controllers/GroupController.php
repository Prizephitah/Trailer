<?php

/**
 * Handles Group interaction
 *
 * @author Björn Hjortsten
 */
class GroupController extends BaseController {
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth');
	}
	
	public function create() {
		return View::make('group/create')->with('title', 'Skapa ny grupp');
	}
	
	public function store() {
		
	}
	
	public function index() {
		return View::make('group/join')->with('title', 'Gå med i befintlig grupp');
	}
}
