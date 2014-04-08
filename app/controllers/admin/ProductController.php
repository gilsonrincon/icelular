<?php

namespace Admin;

use View;
use BaseController;
use Input;
use Product;
use Configuration;
use Redirect;
use Tag;
use ProductTag;
use ProductCategory;
use ProductImage;
use AttributesGroup;
use ProductAttribute;
use Offer;

Class ProductController extends BaseController{
	
	//muestra la lista de productos
	public function index(){
		if(Input::has('order_field')){
			$order_field=Input::get('order_field');
		}else{
			$order_field='position';
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
		
		if(Product::all()->count()>0){
			//obtiene la lista de todos los productos
			$products=Product::where('id','>','0')->orderBy($order_field,$order_dir)->paginate(Configuration::where('name','=','page_count')->first()->value);
		}else{
			$products=Product::all();
		}
		
		//parámetros que deben pasarse a la vista
		$data['order_field']=$order_field;
		$data['order_dir']=$order_dir;
		$data['products']=$products;
		$data['page']=$page;
		$data['page_name']='products';
		
		return View::make('admin.products',$data);
	}
	
	/**
	 * Muestra formulario para registro de un nuevo producto
	 */
	public function newProduct(){
		$data['page_name']='products';
		
		return View::make('admin.productsNew',$data);
	}
	
	/** Crea el producto con la información general **/
	public function createProduct(){
		
		$product=new Product();
		
		$product['name']=Input::get('name');
		$product['url']=Input::get('url');
		$product['short_description']=Input::get('short_description');
		$product['description']=Input::get('description');
		$product['position']=Input::get('position');
		
		$product->save();
		
		return Redirect::to('admin/products/'.$product['id'].'/edit');
	}
	
	/**
	 * Formulario para la edición de un producto
	 */
	public function editProduct($id){
		$product=Product::find($id);
		
		//obtener grupos de atributos
		$attributesGroups=AttributesGroup::all();
		
		$data['product']=$product;
		$data['attributesGroups']=$attributesGroups;
		$data['page_name']='products';
		
		return View::make('admin.productsNew',$data);
	}
	
	/** Actualiza un producto con toda la información relacionada **/
	public function updateProduct($id){
		
		//obtiene el modelo del producto a modificar 
		$product=Product::find($id);
		
		//guarda la información general
		$product['name']=Input::get('name');
		$product['short_description']=Input::get('short_description');
		$product['url']=Input::get('url');
		$product['description']=Input::get('description');
		//$product['position']=Input::get('position');
		$product['video']=Input::get('video');
		$product->save();
		
		//elimina los tags que tenga relacionados para volverlos a generar según la modificación
		foreach(ProductTag::where('product_id','=',$product['id'])->get() as $tag){
			$tag->delete();
		}
		
		//guarda las etiquetas
		$tags=Input::get('tags');
		$tags=explode(',',$tags);
		
		foreach($tags as $tag){
			if(strlen($tag)>0){
				if(Tag::where('tag','=',$tag)->count()>0){
					$temp=Tag::where('tag','=',$tag)->get()->first();
					ProductTag::create(array('product_id'=>$product['id'],'tag_id'=>$temp['id']));
				}else{
					$tag=Tag::create(array('tag'=>$tag));
					ProductTag::create(array('product_id'=>$product['id'],'tag_id'=>$tag['id']));
				}
			}
		}
		
		//guarda el mapa de categorías
		$cats=Input::get('cats');
		
		//se procede a eliminar todos los elementos de la relación producto/categoría para re-mapearlos
		$items=ProductCategory::where('product_id','=',$product['id'])->delete();
		
		if(count($cats)>0){
			foreach($cats as $cat){
				ProductCategory::create(array('product_id'=>$product['id'],'category_id'=>$cat));
			}
		}
		
		//proceso para almacenar los atributos relacionados con el producto
		$array=Input::all();
		
		//se deben eliminar todos los atributos relacionados al producto para proceder luego a guardar los nuevos valores
		$attributes=ProductAttribute::where('product_id','=',$product['id'])->get();
		foreach($attributes as $at){
			$at->delete();
		}
		
		foreach($array as $it){
			if(is_string($it))
				if(strpos($it, '@|@')>0){
					$attTemp=explode('@|@',$it);
					ProductAttribute::create(array('product_id'=>$product['id'],'attribute_id'=>$attTemp[1],'value'=>$attTemp[0]));
				}
		}
		
		return Redirect::to('admin/products');
	}
	
	/** Eliminar un producto **/
	public function deleteProduct(){
		$ids=Input::get('ids');
		
		$ids=trim($ids, ",");
		$ids=explode(",",$ids);
		
		foreach($ids as $id){
			
			//solo puede eliminarse el producto si no existe una oferta relacionada a él
			if(Offer::where('product_id','=',$id)->count()==0){
			
				//elimina los tags que tenga relacionados para volverlos a generar según la modificación
				ProductTag::where('product_id','=',$id)->delete();
				
				//se procede a eliminar todos los elementos de la relación producto/categoría para re-mapearlos
				$items=ProductCategory::where('product_id','=',$id)->get();
				foreach($items as $it){
					$it->delete();
				}
				
				//elimina las imágenes
				$images=ProductImage::where('product_id','=',$id)->get();
				foreach($images as $img){
					unlink('img/p/'.$img['image']);
					$img->delete();
				}
				
				$product=Product::find($id);
				$product->delete();
			}
		}
		
		return Redirect::to('admin/products');
	}

	/**
	 * Esta función recibe una imagen relacionada con el producto indicado por la querystring product_id
	*/
	public function addImage(){
		$image=Input::file('image');
		$image_name='product'.time().'.'.$image->getClientOriginalExtension();
		
		$image->move('img/p/',$image_name);
		
		ProductImage::create(array('product_id'=>Input::get('product_id'),'image'=>$image_name));
		
		return Input::get('product_id');
	}
	
	//obtiene lista html de imágenes relacionadas con el product_id enviado por querystring
	public function getImages(){
		if(Input::has('product_id')){
			$images=ProductImage::where('product_id','=',Input::get('product_id'))->get();
			$html='<div class="row">';
			$n=1;
			foreach($images as $img){
				$html.='<div class="col-lg-3">';
				$html.='<img alt="" class="img-responsive" src="/img/p/'.$img['image'].'" /><a href="#" style="margin:10px auto;" class="btn btn-default btn-danger brn-delete-img" data-id="'.$img['id'].'">Eliminar</a>';
				$html.='</div>';
				if($n==4){
					$html.='<div style="clear:both;"></div>';
					$n=1;
				}else{
					$n++;
				}
			}
			
			$html.='</div>';
			return $html;
		}
			
		return '<p>No se han encontrado imágnes para este producto.';
	}
	
	//elimina una imagen de producto
	public function deleteImage(){
		$img=ProductImage::find(Input::get('id'));
		unlink('img/p/'.$img['image']);		
		$img->delete();
		
		return '';
	}
}


























