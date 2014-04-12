<?php
namespace Admin;
use BaseController;
use Input;
use Configuration;
use Redirect;
use Store;
use Offer;
use Review;
use View;
class Reviews extends \BaseController {

	//Lista de tiendas, enlazaran a las ofertas de la tienda
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
		$data['page_name'] ='reviews';

		return View::make('admin.reviewsStoresList', $data);
	}

	//Lista de ofertas de una tienda
	public function index_offers($id)
	{
		$offers = Offer::where('store_id', '=', $id)->get();
		$data['offers'] = $offers;

		return View::make('admin.reviewsOffersList', $data);
	}

	
	public function create()
	{
		//
	}

	
	public function store()
	{
		//
	}

	//Calificaciones de la oferta
	public function show($id)
	{
		$reviews = Review::where('product_id', '=', $id)->get();
		$data['reviews'] = $reviews;
		$data['page_name']='reviews';

		return View::make('admin.reviewsListShow', $data);
	}

	
	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
	}

	
	public function destroy($id)
	{
		//
	}

}