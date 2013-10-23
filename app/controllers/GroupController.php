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
		$rules = array(
			'name' => 'required|unique:groups|max:255'
		);
		$messages = array(
			'required' => 'Fältet är obligatoriskt.',
			'unique' => 'En grupp med det angivna namnet finns redan.',
			'max' => 'Fältet får inte innehålla fler än :max tecken.'
		);
		
		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()) {
			return Redirect::action('GroupController@create')->withErrors($validator)->withInput(Input::all());
		}
		
		$group = new Group();
		$group->name = Input::get('name');
		$group->description = Input::get('description');
		$group->created_by = Auth::user()->id;
		$group->created = new DateTime();
		$group->save();
		$group->users()->attach(Auth::user(), array('admin' => true));
		$group->save();
		
		return Redirect::to('/')->with('success', 'Gruppen "'.e(Input::get('name')).'" har skapats!');
	}
	
	public function index() {
		return View::make('group/join')->with('title', 'Gå med i befintlig grupp');
	}
	
	public function show($id) {
		$group = Group::with('users')->where('id', '=', $id)->first();
		if ($group == null) {
			return App::abort(404, 'Gruppen finns inte');
		}
		$isMember = $group->users->contains(Auth::user()->id);
		$isAdmin = false;
		if ($isMember) {
			$isAdmin = (bool)$group->users->find(Auth::user()->id)->pivot->admin;
		}
		return View::make('group/show')->with('title', 'Visa grupp: '.e($group->name))->with('group', $group)
				->with('isAdmin', $isAdmin)->with('isMember', $isMember);
	}
	
	public function edit($id) {
		$group = Group::with('users')->where('id', '=', $id)->first();
		if ($group == null) {
			return App::abort(404, 'Gruppen finns inte');
		}
		$isMember = $group->users->contains(Auth::user()->id);
		if (!$isMember || !(bool)$group->users->find(Auth::user()->id)->pivot->admin) {
			return Redirect::action('GroupController@show', array($group->id))
					->with('danger', 'Du saknar behörighet för att administrera gruppen!');
		}
		return View::make('group/edit')->with('title', 'Administrera grupp: '.e($group->name))->with('group', $group);
	}
}
