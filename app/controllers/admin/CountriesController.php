<?php

namespace Admin;

use View;
use BaseController;
use Input;
use Configuration;
use Redirect;
use Country;
use State;
use Mail;
use Cms;

class CountriesController extends \BaseController {

	//Lista de paises
	public function index()
	{
		$data['page_name'] = 'countries';
		$data['countries'] = Country::where('id', '>', '0')->orderBy('country', 'asc')->paginate(Configuration::where('name','=','page_count')->first()->value);

		return View::make('admin.countries', $data);
	}

	//Crear un nuevo estado
	public function create($id)
	{
		$data['page_name'] = 'countries';
		$data['country'] = $id;
		return View::make('admin.countrystatenew', $data);
	}


	public function store()
	{
		$state = new State();
		$state->country_id = Input::get('country');
		$state->state = Input::get('name');
		$state->save();

		return Redirect::to('admin/countries/'.Input::get('country').'/show');
	}

	//Vista individual del pais
	public function show($id)
	{
		$data['page_name'] = 'countries';
		$data['country'] = Country::find($id);
		$data['states'] = State::where('country_id', '=', $id)->orderBy('state', 'asc')->paginate(Configuration::where('name','=','page_count')->first()->value);
		return View::make('admin.countrystatelist', $data);
	}

	//Borrar un estado
	public function destroy()
	{
		$delete = Input::all();
		array_shift($delete);

		foreach ($delete as $d):
			$state = State::find($d);
			$state->delete();
		endforeach;

		return Redirect::back();
	}

	//Recuperamos los estados de un pais, esto se usa para agregarlos a una lista
	public function states()
	{
		$states = State::where('country_id', '=', Input::get('country'))->get();

		$html = "";
		foreach ($states as $state):
				$html .= "<option value='".$state->id."'>".$state->state."</option>";
		endforeach;

		echo $html;
	}

}