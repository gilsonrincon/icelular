<?php

namespace Admin;

use View;
use BaseController;
use Category;
use Input;
use Redirect;
Use DB;
use Configuration;
use ProductCategory;
use Product;

class CategoriesController extends BaseController{
	
	/**
	 * Lista de categorías
	 *
	 * @param  string	order_field //campo de ordenación
	 * @param	 string order_dir //asc, desc (ascendente - descendente)
	 * @return Response
	 */
	public function index()
	{
		if(Input::has('order_field')){
			$order_field=Input::get('order_field');
		}else{
			$order_field='id';
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

		if(Input::has('search') and Input::get('search') != ""):
			$search = Input::get('search');
			$data['search'] = $search; 
		endif;
		
		if(Category::all()->count()>0){
			//obtiene la lista de todas las categorías
			if(isset($data)):
				$categories = Category::where('name','LIKE', $data['search'])
								->orWhere('short_description', 'LIKE', $data['search'])
								->orWhere('description', 'LIKE', $data['search'])
								->orWhere('url', 'LIKE', $data['search'])
								->orderBy($order_field,$order_dir)
								->paginate(Configuration::where('name','=','page_count')->first()->value);
			else:
				$categories = Category::where('id','>','0')
								->orderBy($order_field,$order_dir)
								->paginate(Configuration::where('name','=','page_count')->first()->value);
			endif;
			
		}else{
			$categories=Category::all();
		}
		
		//parámetros que deben pasarse a la vista
		$data['order_field']=$order_field;
		$data['order_dir']=$order_dir;
		$data['categories']=$categories;
		$data['page']=$page;
		$data['page_name']='categories';
		
		return View::make('admin.categoriesList',$data);
	}

	/**
	 * Formulario para la creación de una nueva categoría
	 *
	 * @return Response
	 */
	public function create()
	{
		//crea el arreglo para las categorías padre
		$parent_ids=array();
		
		foreach(Category::all() as $cat){
			$parent_ids=array_add($parent_ids,$cat->id, $cat->name);
		}
		
		$data['parent_ids']=$parent_ids;
		//$data['hide_menu']=true;
		$data['page_name']='categories';
		
		return View::make('admin.categoryNew',$data);
	}

	/**
	 * Guarda la nueva categoría
	 *
	 * @return Response
	 */
	public function store()
	{
		//si vienen datos vía post entoces se procede a crear la categoría
		if(Input::has('name')){
			$category=new Category();
			
			if(!Input::get('parent_id')){
				$parent_id=0;
			}else{
				$parent_id=Input::get('parent_id');
			}
			
			$category['parent_id']=$parent_id;
			$category['name']=Input::get('name');
			$category['short_description']=Input::get('short_description');
			$category['url']=Input::get('url');
			$category['description']=Input::get('description');
			$category['position']=Input::get('position');
			
			$category->save();
			
			return Redirect::to('admin/categories');
		}else{
			return Redirect::to('admin/categories');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category=Category::find($id);
		if($category){
			//crea el arreglo para las categorías padre
			$parent_ids=array();
			foreach(Category::all() as $cat){
				if($category->id!=$cat->id)
					$parent_ids=array_add($parent_ids,$cat->id, $cat->name);
			}
			
			$data['parent_ids']=$parent_ids;
			//$data['hide_menu']=true;
			$data['edit']=true;
			$data['category']=$category;
			$data['page_name']='categories';
			
			return View::make('admin.categoryNew',$data);
		}else{
			return Redirect::to('admin/categories');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category=Category::find($id);
			
		if($id!=1){
			$category['parent_id']=Input::get('parent_id');
			$category['position']=Input::get('position');
		}else{
			$category['parent_id']=$category['parent_id'];
			$category['position']=$category['position'];
		}
		$category['name']=Input::get('name');
		$category['short_description']=Input::get('short_description');
		$category['url']=Input::get('url');
		$category['description']=Input::get('description');
		
		$category->save();
		
		return Redirect::to('admin/categories');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  array  $ids
	 * @return Response
	 */
	public function destroy()
	{
		$ids=Input::get('ids');
		
		$ids=trim($ids, ",");
		$ids=explode(",",$ids);
		
		foreach($ids as $id){
			//no se puede eliminar la categoría principal
			if($id!=1){
				$category=Category::find($id);
				if(ProductCategory::countProducts($category)==0 && Category::childs(Category::find($id))->count()==0){
					$category->delete();
				}
			}
		}
		
		return Redirect::to('admin/categories');
	}
}