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
		$this->beforeFilter('groupadmin', array('except' => array('show')));
	}
	
	public function create($groupId) {
		return View::make('vehicle/create')->with('groupId', $groupId)->with('title', 'Lägg till nytt fordon');
	}
	
	public function store($groupId) {
		$rules = array(
			'name' => 'required|max:255',
			'license-plate' => 'max:255',
			'model-year' => 'integer|min:1900|max:'.(1 + date('Y')),
			'curb-weight' => 'integer|min:0',
			'gross-weight' => 'integer|min:0',
			'length' => 'integer|min:0',
			'width' => 'integer|min:0'
		);
		$messages = array(
			'required' => 'Fältet är obligatoriskt.',
			'max' => 'Fältet får inte innehålla fler än :max tecken.',
			'date' => 'Ogiltigt datum.',
			'integer' => 'Värdet måste vara ett heltal.',
			'min' => 'Värdet får inte vara negativt.',
			'model-year.min' => 'Äldsta tillåtna årtal är :min',
			'model-year.max' => 'Framtida årtal är inte tillåtna'
		);
		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()) {
			return Redirect::action('VehicleController@create', array($groupId))
					->withErrors($validator)->withInput(Input::all());
		}
		
		$vehicle = new Vehicle();
		$vehicle->name = Input::get('name');
		$vehicle->description = Input::get('description');
		$vehicle->license_plate = Input::get('license-plate');
		if (Input::has('model-year')) {
			$modelYear = new \DateTime();
			$modelYear->setDate(Input::get('model-year'), 1, 1);
			$vehicle->model_year = $modelYear;
		}
		$vehicle->curb_weight = (int)Input::get('curb-weight');
		$vehicle->gross_weight = (int)Input::get('gross-weight');
		$vehicle->length = (int)Input::get('length');
		$vehicle->width = (int)Input::get('width');
		$vehicle->createdBy()->associate(Auth::user());
		$vehicle->created = new \DateTime();
		
		$group = Group::find($groupId);
		$group->vehicles()->save($vehicle);
		$group->push();
		
		return Redirect::action('VehicleController@show', array($vehicle->id))
				->with('success', 'Fordonet "'.e($vehicle->name).'" tillagt');
	}
	
	public function show($vehicleId) {
		$vehicle = Vehicle::find($vehicleId);
		if ($vehicle == null) {
			return App::abort(404, 'Fordonet finns inte');
		}
		$isMember = $vehicle->group->users->contains(Auth::user()->id);
		$isAdmin = false;
		if ($isMember) {
			$isAdmin = (bool)$vehicle->group->users->find(Auth::user()->id)->pivot->admin;
		}
		return View::make('vehicle/show')->with('vehicle', $vehicle)->with('title', 'Visa fordon: '.e($vehicle->name))
				->with('isMember', $isMember)->with('isAdmin', $isAdmin);
	}
	
	public function edit($vehicleId) {
		$vehicle = Vehicle::find($vehicleId);
		return View::make('vehicle/edit')->with('vehicle', $vehicle)
				->with('title', 'Administrera fordon: '.e($vehicle->name));
	}
	
	public function update($vehicleId) {
		$vehicle = Vehicle::find($vehicleId);
		
		$rules = array(
			'name' => 'required|max:255',
			'license-plate' => 'max:255',
			'model-year' => 'integer|min:1900|max:'.(1 + date('Y')),
			'curb-weight' => 'integer|min:0',
			'gross-weight' => 'integer|min:0',
			'length' => 'integer|min:0',
			'width' => 'integer|min:0'
		);
		$messages = array(
			'required' => 'Fältet är obligatoriskt.',
			'max' => 'Fältet får inte innehålla fler än :max tecken.',
			'date' => 'Ogiltigt datum.',
			'integer' => 'Värdet måste vara ett heltal.',
			'min' => 'Värdet får inte vara negativt.',
			'model-year.min' => 'Äldsta tillåtna årtal är :min',
			'model-year.max' => 'Framtida årtal är inte tillåtna'
		);
		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()) {
			return Redirect::action('VehicleController@edit', array($vehicle->id))
					->withErrors($validator)->withInput(Input::all());
		}
		
		$vehicle->name = Input::get('name');
		$vehicle->description = Input::get('description');
		$vehicle->license_plate = Input::get('license-plate');
		if (Input::has('model-year')) {
		$modelYear = new \DateTime();
		$modelYear->setDate(Input::get('model-year'), 1, 1);
		$vehicle->model_year = $modelYear;
		} else {
			$vehicle->model_year = null;
		}
		$vehicle->curb_weight = (int)Input::get('curb-weight');
		$vehicle->gross_weight = (int)Input::get('gross-weight');
		$vehicle->length = (int)Input::get('length');
		$vehicle->width = (int)Input::get('width');
		$vehicle->updated = new DateTime();
		$vehicle->updatedBy()->associate(Auth::user());
		
		$vehicle->save();
		
		return Redirect::action('VehicleController@show', array($vehicle->id))->with('success', 'Ändringar sparade!');
	}
	
	public function destroy($vehicleId) {
		$vehicle = Vehicle::find($vehicleId);
		$vehicle->delete();
		return Redirect::action('GroupController@show', array($vehicle->group->id))
				->with('success', 'Fordonet "'.e($vehicle->name).'" togs bort.');
	}
}
