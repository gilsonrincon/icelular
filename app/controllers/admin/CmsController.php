<?php

namespace Admin;

use View;
use BaseController;
use Input;
use Configuration;
use Redirect;
use Cms;

Class CmsController extends BaseController{
	
	//muestra la lista de ítems
	public function index(){
		if(Input::has('order_field')){
			$order_field=Input::get('order_field');
		}else{
			$order_field='title';
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
		
		if(Cms::all()->count()>0){
			//obtiene la lista de todos los ítems
			$cms=Cms::where('id','>','0')->orderBy($order_field,$order_dir)->paginate(Configuration::where('name','=','page_count')->first()->value);
		}else{
			$cms=Cms::all();
		}
		
		//parámetros que deben pasarse a la vista
		$data['order_field']=$order_field;
		$data['order_dir']=$order_dir;
		$data['cms']=$cms;
		$data['page']=$page;
		$data['page_name']='cms';
		
		return View::make('admin.cmsList',$data);
	}
	
	/**
	 * Muestra formulario para registro de un nuevo ítem
	 */
	public function newItem(){
		$data['page_name']='cms';
		
		return View::make('admin.cmsNew',$data);
	}
	
	/** Crea el ítem con la información general **/
	public function createItem(){
		
		$cms=new Cms();
		
		$cms['title']=Input::get('title');
		$cms['description']=Input::get('description');
		$cms['url']=Input::get('url');
		$cms['content']=Input::get('content');
		$cms['position']=Input::get('position');
		
		$cms->save();
		
		return Redirect::to('admin/cms/'.$cms['id'].'/edit');
	}
	
	/**
	 * Formulario para la edición de un ítem
	 */
	public function editItem($id){
		$cms=Cms::find($id);
		
		$data['cms']=$cms;
		$data['page_name']='cms';
		
		return View::make('admin.cmsNew',$data);
	}
	
	/** Actualiza un ítem **/
	public function updateItem($id){
		
		$cms=Cms::find($id);
		
		$cms['title']=Input::get('title');
		$cms['description']=Input::get('description');
		$cms['url']=Input::get('url');
		$cms['content']=Input::get('content');
		$cms['position']=Input::get('position');
		
		$cms->save();
		
		return Redirect::to('admin/cms');
	}
	
	/** Eliminar un ítem **/
	public function deleteItem(){
		$ids=Input::get('ids');
		
		$ids=trim($ids, ",");
		$ids=explode(",",$ids);
		
		foreach($ids as $id){
			$cms=Cms::find($id);
			$cms->delete();
		}
		
		return Redirect::to('admin/cms');
	}
}


























