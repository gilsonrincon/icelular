<?php

class ProductCategory extends Eloquent{
	
	protected $table='product_categories';
	
	//campos protegidos
	protected $guarded=array('id');
	
	/**
	 * Número de productos en una determinada categoría
	 */
	public static function countProducts($cat){
		return ProductCategory::where('category_id','=',$cat->id)->count();
	}
}
