<?php

namespace Admin;

use View;
use BaseController;
use Input;
use Configuration;
use Redirect;
use Banner;
use BannerHit;
use BannerClick;
use BannerHook;

Class BannerController extends BaseController{
	
	//Lista de banners
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
		
		if(Banner::all()->count()>0){
			//obtiene la lista de todas las categorías
			$banners=Banner::where('id','>','0')->orderBy($order_field,$order_dir)->paginate(Configuration::where('name','=','page_count')->first()->value);
		}else{
			$banners=Banner::all();
		}
		
		//parámetros que deben pasarse a la vista
		$data['order_field']=$order_field;
		$data['order_dir']=$order_dir;
		$data['banners']=$banners;
		$data['page']=$page;
		$data['page_name']='banners';
		
		return View::make('admin.bannerList',$data);
	}
	
	/**
	 * Muestra formulario para registro de un nuevo banner
	 */
	public function newBanner(){
		$hooks=array();
		
		foreach(BannerHook::all() as $hook){
			$hooks=array_add($hooks,$hook->id, $hook->title);
		}
		
		$data['hooks']=$hooks;
		$data['page_name']='banners';
		
		return View::make('admin.bannerNew',$data);
	}
	
	/** Crea el banner **/
	public function createBanner(){
		$banner=new Banner();
		
		$banner['hook_id']=Input::get('hook_id');
		$banner['name']=Input::get('name');
		$banner['url_click']=Input::get('url_click');
		
		if(Input::hasFile('image') && Input::file('image')!=NULL){
			$image=Input::file('image');
			$image_name='banner'.time().'.'.$image->getClientOriginalExtension();
			$image->move('img/b/',$image_name);
			$banner['image']=$image_name;
		}else{
			$banner['image']='';
		}
		
		$banner['code']=Input::get('code');
		
		$banner->save();
		
		$data['banner']=$banner;
		$data['page_name']='banners';
		
		return Redirect::to('admin/banners/update/'.$banner['id']);
	}
	
	/**
	 * Formulario para la edición de un banner
	 */
	public function updateBanner($id){
		$banner=Banner::find($id);
		
		$hooks=array();
		
		foreach(BannerHook::all() as $hook){
			$hooks=array_add($hooks,$hook->id, $hook->title);
		}
		
		$data['hooks']=$hooks;
		$data['banner']=$banner;
		$data['page_name']='banners';
		
		return View::make('admin.bannerNew',$data);
	}
	
	/** Actualiza un banner **/
	public function saveBanner($id){
		$banner=Banner::find($id);
		
		$banner['hook_id']=Input::get('hook_id');
		$banner['name']=Input::get('name');
		$banner['url_click']=Input::get('url_click');
		
		if(Input::hasFile('image') && Input::file('image')!=NULL){
			if($banner['image']!=''){
				if(file_exists('img/b/'.$banner['image'])){
					unlink('img/b/'.$banner['image']);
				}
			}
				
			$image=Input::file('image');
			$image_name='banner'.time().'.'.$image->getClientOriginalExtension();
			$image->move('img/b/',$image_name);
			$banner['image']=$image_name;
		}
		
		$banner['code']=Input::get('code');
		
		$banner->save();
		
		$data['banner']=$banner;
		$data['page_name']='banners';
		
		return Redirect::to('admin/banners/update/'.$banner['id']);
	}
	
	/** Eliminar un banner **/
	public function deleteBanners(){
		$ids=Input::get('ids');
		
		$ids=trim($ids, ",");
		$ids=explode(",",$ids);
		
		foreach($ids as $id){
			$banner=Banner::find($id);
			
			if($banner['image']!=''){
				if(file_exists('img/b/'.$banner['image'])){
					unlink('img/b/'.$banner['image']);
				}
			}
			
			$banner->delete();
		}
		
		return Redirect::to('admin/banners');
	}
}


























