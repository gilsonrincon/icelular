<?php
namespace Admin;
use BaseController;
use Input;
use Configuration;
use Redirect;
use Store;
use View;
class AvailableClicks extends \BaseController {

	//Mostramos todas las tiendas y los clicks disponibles para estas
	public function index()
	{
		if(Input::has('order_field')){
			$order_field=Input::get('order_field');
		}else{
			$order_field='name';
		}
		
		if(Input::has('order_dir')){
			$order_dir=Input::get('order_dir');
		}else{
			$order_dir='asc';
		}
		
		if(Input::has('page')){
			$page=Input::get('page');
		}else{
			$page=1;
		}
		
		if(Store::all()->count()>0){
			//obtiene la lista de todas las tiendas
			$stores=Store::where('id','>','0')->orderBy($order_field,$order_dir)->paginate(Configuration::where('name','=','page_count')->first()->value);
		}else{
			$stores=Store::all();
		}
		
		//parámetros que deben pasarse a la vista
		$data['order_field']=$order_field;
		$data['order_dir']=$order_dir;
		$data['stores']=$stores;
		$data['page']=$page;
		$data['page_name']='availableclicks';

		return View::make('admin.availableClicks', $data);
	}

	
	public function create()
	{
		//
	}

	
	public function store()
	{
		//
	}

	
	public function show($id)
	{
		//
	}

	//Formulario para editar los clicks disponibles de la tienda
	public function edit($id)
	{
		$store = Store::find($id);
		$data['store'] = $store;
		$data['page_name'] = 'availableclicks';
		return View::make('admin.availableClicksEdit', $data);
	}

	//Actulizamos el numero de clicks y redireccionamos al listado de clicks
	public function update()
	{
		$store = Store::find(Input::get('id'));
		$store->clics = Input::get('clics', 0);
		$store->save();
		return Redirect::to('admin/availableclicks');
	}

	
	public function destroy($id)
	{
		//
	}

}