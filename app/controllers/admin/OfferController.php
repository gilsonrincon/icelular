<?php
namespace Admin;

use View;
use BaseController;
use Input;
use Redirect;
Use DB;
Use Configuration;
Use Store;
Use Product;
Use Offer;
Use OfferClick;
Use OfferHit;

class OfferController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Offer::all()->count()>0){
			$offers=Offer::where('id','>','0')->paginate(Configuration::where('name','=','page_count')->first()->value);
		}else{
			$offers=Offer::all();
		}
		
		$data['offers']=$offers;
		$data['page_name']='offers';
		
		return View::make('admin.offersList',$data);
	}

	/**
	 * Muestra el formulario para crear una nueva oferta 
	**/
	public function newOffer(){
		
		//para la lista de tiendas (par - id/nombre)
		$store_list=array();
		foreach(Store::all() as $st){
			$store_list=array_add($store_list,$st['id'],$st['name']);
		}
		
		//para la lista de productos (par - id/nombre)
		$product_list=array();
		foreach(Product::all() as $pr){
			$product_list=array_add($product_list,$pr['id'],$pr['name']);
		}
		
		$data['store_list']=$store_list;
		$data['product_list']=$product_list;
		$data['pdocuts']=Product::all();
		$data['stores']=Store::all();
		$data['page_name']='offers';
		
		return View::make('admin.offersNew',$data);
	}
	
	/**
	 * Procesa los datos enviados por el formulario y crea la nueva oferta
	**/
	public function createOffer(){
		if(Offer::where('store_id','=',Input::get('store_id'))->count()>0 && Offer::where('product_id','=',Input::get('product_id'))->count()>0){
			//para la lista de tiendas (par - id/nombre)
			$store_list=array();
			foreach(Store::all() as $st){
				$store_list=array_add($store_list,$st['id'],$st['name']);
			}
			
			//para la lista de productos (par - id/nombre)
			$product_list=array();
			foreach(Product::all() as $pr){
				$product_list=array_add($product_list,$pr['id'],$pr['name']);
			}
			
			$data['error']='Ya existe una oferta para este producto relacionada con esta tienda.';
			$data['store_list']=$store_list;
			$data['product_list']=$product_list;
			$data['pdocuts']=Product::all();
			$data['stores']=Store::all();
			$data['page_name']='offers';
			
			return View::make('admin.offersNew',$data);
		}else{
			$offer=new Offer();
		
			$offer['title']=Input::get('title');
			$offer['description']=Input::get('description');
			$offer['store_id']=Input::get('store_id');
			$offer['product_id']=Input::get('product_id');
			$offer['price']=Input::get('price');
			
			if(Input::has('active')){
				$offer['active']=true;
			}else{
				$offer['active']=false;
			}
			
			
			$offer->save();
			
			return Redirect::to('admin/offers/update/'.$offer['id']);
		}
	}
	
	/**
	 * Muestra el formulario para actualizar la información de una oferta
	**/
	public function updateOffer($id){
		$offer=Offer::find($id);
		
		$data['offer']=$offer;
		$data['page_name']='offers';
		
		return View::make('admin.offersNew',$data);
	}
	
	/**
	 * Guarda los cambios realizados a una oferta
	**/
	public function saveOffer($id){
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
		
		return Redirect::to('admin/offers');
	}

	/**
	 * Eliminación de ofertas
	**/
	public function deleteOffers(){
		$ids=Input::get('ids');
		
		$ids=trim($ids, ",");
		$ids=explode(",",$ids);
		
		foreach($ids as $id){
			Offer::find($id)->delete();
			OfferClick::where('offer_id','=',$id)->delete();
			OfferHit::where('offer_id','=',$id)->delete();
		}
		
		return Redirect::to('admin/offers');
	}
}































