<?php

namespace Admin;

use View;
use BaseController;
use Input;
use Configuration;
use Redirect;
use Store;
use Offer;
use StoreAddress;

Class StoreController extends BaseController{
	
	//muestra la lista de tiendas
	public function index(){
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
		$data['page_name']='stores';
		
		return View::make('admin.stores',$data);
	}
	
	/**
	 * Muestra formulario para registro de una nueva tienda
	 */
	public function newStore(){
		$data['page_name']='stores';
		
		return View::make('admin.storesNew',$data);
	}
	
	/** Crea la tienda con la información general **/
	public function createStore(){
		
		$store=new Store();
		
		$store['name']=Input::get('name');
		$store['url_seo']=Input::get('url_seo');
		$store['short_description']=Input::get('short_description');
		$store['description']=Input::get('description');
		$store['email']=Input::get('email');
		
		if(Input::hasFile('logo') && Input::file('logo')!=NULL){
			$logo=Input::file('logo');
			$image_name='store'.time().'.'.$logo->getClientOriginalExtension();
			$logo->move('img/t/',$image_name);
			$store['logo']=$image_name;
		}else{
			$store['logo']='';
		}
		
		$store['url']=Input::get('url');
		$store['fan_page']=Input::get('fan_page');
		$store['twitter']=Input::get('twitter');
		$store['google_plus']=Input::get('google_plus');
		$store['youtube']=Input::get('youtube');
		
		$store->save();
		
		return Redirect::to('admin/stores/'.$store['id'].'/edit');
	}
	
	/**
	 * Formulario para la edición de una tienda
	 */
	public function editStore($id){
		$store=Store::find($id);
		
		$data['store']=$store;
		$data['page_name']='stores';
		
		return View::make('admin.storesNew',$data);
	}
	
	/** Actualiza una tienda con toda la información relacionada **/
	public function updateStore($id){
		
		//obtiene el modelo de la tienda a modificar 
		$store=Store::find($id);
		
		//guarda la información general
		$store['name']=Input::get('name');
		$store['short_description']=Input::get('short_description');
		$store['url_seo']=Input::get('url_seo');
		$store['description']=Input::get('description');
		$store['email']=Input::get('email');
		
		if(Input::hasFile('logo') && Input::file('logo')!=NULL){
			if($store['logo']!=''){
				if(file_exists('img/t/'.$store['logo'])){
					unlink('img/t/'.$store['logo']);
				}
			}
				
			$logo=Input::file('logo');
			$image_name='store'.time().'.'.$logo->getClientOriginalExtension();
			$logo->move('img/t/',$image_name);
			$store['logo']=$image_name;
		}
		
		$store['url']=Input::get('url');
		$store['fan_page']=Input::get('fan_page');
		$store['twitter']=Input::get('twitter');
		$store['google_plus']=Input::get('google_plus');
		$store['youtube']=Input::get('youtube');
		
		$store->save();
		
		return Redirect::to('admin/stores');
	}
	
	/** Eliminar una tienda **/
	public function deleteStore(){
		$ids=Input::get('ids');
		
		$ids=trim($ids, ",");
		$ids=explode(",",$ids);
		
		foreach($ids as $id){
			$store=Store::find($id);
			if($store['logo']!=''){
				if(file_exists('img/t/'.$store['logo'])){
					unlink('img/t/'.$store['logo']);
				}
			}
			$store->delete();
		}
		
		return Redirect::to('admin/stores');
	}
	
	/**
	 * Añade una nueva dirección a la tienda determinada por el parámetro id
	*/
	public function addAddress($id){
		$storeAddress=new StoreAddress();
		
		$storeAddress['store_id']=$id;
		$storeAddress['name_address']=Input::get('name_address');
		$storeAddress['country']=Input::get('country');
		$storeAddress['state']=Input::get('state');
		$storeAddress['city']=Input::get('city');
		$storeAddress['address']=Input::get('address');
		$storeAddress['phone']=Input::get('phone');
		$storeAddress['coords_gmaps']=Input::get('coords_gmaps');
		
		$storeAddress->save();
		
		return 'ok';
	}

	/**
	 * Actualizar una nueva dirección a la tienda determinada por el parámetro id
	*/
	public function updateAddress(){
		$storeAddress=StoreAddress::find(Input::get('id'));
		
		$storeAddress['name_address']=Input::get('name_address');
		$storeAddress['country']=Input::get('country');
		$storeAddress['state']=Input::get('state');
		$storeAddress['city']=Input::get('city');
		$storeAddress['address']=Input::get('address');
		$storeAddress['phone']=Input::get('phone');
		$storeAddress['coords_gmaps']=Input::get('coords_gmaps');
		
		$storeAddress->save();
		
		return 'ok';
	}

	/*
	 * Obtiene la lista de direcciones por tienda
	*/
	public function getAddress($id){
		return StoreAddress::where('store_id','=',$id)->get();
	}
	
	/*
	 * Obtiene la información de una dirección dada por el parámetro id
	*/
	public function getAddressInfo($id){
		return StoreAddress::where('id','=',$id)->get();
	}
	
	/*
	 * Eliminar una determinada dirección
	*/
	public function deleteAddress(){
		if(StoreAddress::find(Input::get('id'))->delete()){
			return 'ok';
		}else{
			return 'error';
		}
	}

	/*Vista de la tienda individual*/
	public function showStore()
	{
		$store=Store::find(2);
		
		$data['store']=$store;
		$data['page_name']='profile';
		
		return View::make('admin.profile',$data);
	}

	//Editar una oferta
	public function editOffer($id)
	{
		$offer = Offer::find($id);

		$data['offer'] = $offer;
		$data['page_name'] = 'profile';

		return View::make('admin.profileOffer', $data);
	}

	//Actualizamos una oferta
	public function updateProfileOffer($id)
	{
		$offer=Offer::find($id);
	
		$offer['title']=Input::get('title');
		$offer['description']=Input::get('description');
		$offer['price']=Input::get('price');
		
		if(Input::has('active')){
			$offer['active']=true;
		}else{
			$offer['active']=false;
		}
		
		$offer->save();
		
		return Redirect::back();
	}	
}


























