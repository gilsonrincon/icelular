<?php
namespace Admin;
use BaseController;
use Input;
use Configuration;
use Redirect;
use Store;
use Offer;
use OfferClick;
use View;
class ReportClicks extends \BaseController {

	//Mostramos todas las tiendas y el numero de clicks disponibles
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
		$data['page_name']='reportclicks';

		return View::make('admin.reportClicks', $data);
	}
	
	//Mostramos la lista de clics de una tienda
	public function show($id)
	{

		$store = Store::find($id);

		$offers = Offer::where('store_id', '=', $id)->orderBy('created_at', 'desc')->get();

		$data['offers'] = $offers;
		$data['store'] = $store;
		$data['page_name']='reportclicks';

		return View::make('admin/reportClicksShow', $data);

	}
}