<?php

class Category extends Eloquent{
	
	protected $table='categories';
	
	/**
	 * Obtiene la categoría padre de una categoría dada
	 */
	public static function parentCat($cat){
		return Category::find($cat->parent_id);
	}
	
	/**
	 * Obtiene las categorías hijas de un modelo de categoría dado
	 * 
	 * @param cat: Modelo de categoría
	 * @return childs: Arreglo de categorías hijas
	*/
	public static function childs($cat){
		return Category::where('parent_id','=',$cat['id'])->get();
	}
	
	/**
	 * Genera un <ul> con el árbol de categorías; este método se usa en el administrador para realizar la asociación de categorías para los productos
	 * 
	 * @param cat: Modelo de categoría actual
	 * @param dom: Elemento <ul> para generar el árbol
	 * @param check: Bool - Determina si contiene checkbox para selección
	 * @return ul: Árbol de categorías
	*/
	public static Function categoryTree($cat=NULL, $dom='categoryTree',$check=true, $product_id=0){
		
		if($cat==NULL){
			$dom='<ul id="'.$dom.'">';
			$cat=Category::all()->first();
		}
		
		if(Category::childs($cat)->count()>0){
			$dom.='<li data-id="'.$cat['id'].'">';
			if($check){
				if(ProductCategory::where('category_id','=',$cat['id'])->where('product_id','=',$product_id)->count()>0)
					$dom.='<input name="cats[]" checked="checked" type="checkbox" value="'.$cat['id'].'" />'.$cat['name'];
				else
					$dom.='<input name="cats[]" type="checkbox" value="'.$cat['id'].'" />'.$cat['name'];
			}else{
				$dom.=$cat['name'];
			}
			$dom.='<ul>';
			$childs=Category::childs($cat);
			
			foreach($childs as $child){
				$dom=Category::categoryTree($child,$dom,$check,$product_id);
			}
			$dom.='</ul></li>';
		}else{
			$dom.='<li data-id="'.$cat['id'].'">';
			if($check){
				if(ProductCategory::where('category_id','=',$cat['id'])->where('product_id','=',$product_id)->count()>0)
					$dom.='<input name="cats[]" checked="checked" type="checkbox" value="'.$cat['id'].'" />'.$cat['name'];
				else
					$dom.='<input name="cats[]" type="checkbox" value="'.$cat['id'].'" />'.$cat['name'];
			}else{
				$dom.=$cat['name'].'</li>';
			}
			return $dom;
		}
		//$dom.="</ul>";
		return $dom;
	}

	/**
	 * Genera un <ul> con el árbol de categorías; se usa para crear el mapa de categorías para la navegación en el Frontend
	 * 
	 * @param cat: Modelo de categoría actual
	 * @param dom: Elemento <ul> para generar el árbol
	 * @return ul: Árbol de categorías
	*/
	public static Function categoryFrontTree($cat=NULL, $dom='categoryFrontTree'){
		
		if($cat==NULL){
			$dom='<ul id="'.$dom.'">';
			$cat=Category::all()->first();
		}
		
		if(Category::childs($cat)->count()>0){
			$dom.='<li data-id="'.$cat['id'].'">';
			$dom.='<a href="/categoria/'.$cat['id'].'-'.$cat['url'].'.html">'.$cat['name'].'</a>';
			
			$dom.='<ul>';
			$childs=Category::childs($cat);
			
			foreach($childs as $child){
				$dom=Category::categoryFrontTree($child,$dom);
			}
			$dom.='</ul></li>';
		}else{
			$dom.='<li data-id="'.$cat['id'].'">';
			$dom.='<a href="/categoria/'.$cat['id'].'-'.$cat['url'].'.html">'.$cat['name'].'</a></li>';
			
			return $dom;
		}
		//$dom.="</ul>";
		return $dom;
	}
}































