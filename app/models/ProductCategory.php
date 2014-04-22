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

	//Categoria
	public function category()
	{
		return $this->belongsTo('Category', 'category_id');
	}

	//Producto
	public function product()
	{
		return $this->belongsTo('Product', 'product_id');
	}
}
