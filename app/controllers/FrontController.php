<?php

class FrontController extends BaseController {

	/**
	 * Carga la página principal en la que se muestran los productos de la categoría Inicio, que es la que contiene los productos destacados
	**/
	public function index()
	{
		//obtiene lista de productos destacados
		$featuredProducts=ProductCategory::where('category_id','=',1)->get();
		
		$featuredOffers=array();
		
		foreach($featuredProducts as $product){
			if(Offer::where('product_id','=',$product['product_id'])->where('active','=',true)->count()>0){
				$it['product']=Product::find($product['product_id']);
				$it['offers']=Offer::where('product_id','=',$product['product_id'])->orderBy('price','asc');
				array_push($featuredOffers,$it);
			}
		}
		
		//Lista de banners principales
		$data['mainBanners'] = Banner::where('hook_id', '=', 1)->get();

		//Lista de banners secundarios
		$data['secBanners'] = Banner::where('hook_id', '=', 2)->get();

		//pasamos los datos a la plantilla
		$data['featuredOffers']=$featuredOffers;		
		
		return View::make('front.index',$data);
	}
	
	/**
	 * Muestra la lista de ofertas disponibles para productos de una determinada categoría
	**/
	public function categoryView($id, $url){
		return 'ok';
	}
	
	/**
	 * Muestra la lista de ofertas para un producto dado
	**/
	public function productView($id, $url){
		$data['product'] = Product::find($id);

		if(is_null($data['product'])):
			App::abort(404, 'El producto no existe.');
		endif;
		$data['order'] = Input::get('order', 'desc');
		$data['offers'] = Offer::where('product_id', '=', $id)->orderBy('price', Input::get('order', 'desc'))->get();
		
		return View::make('front.product', $data);
	}

	//Muestra una oferta
	public function offerView($id)
	{
		//Recuperamos la oferta, si no existe error 404
		$data['offer'] = Offer::find($id);
		if(is_null($data['offer'])):
			App::abort(404, 'La oferta ya no existe.');
		endif;

		$data['product'] = Product::find($data['offer']->product_id);

		return View::make('front.offer', $data);
	}

	//Ver perfil de una tienda
	public function storeView($id, $url)
	{
		$data['store'] = Store::find($id);
		if(is_null($data['store'])):
			App::abort(404, 'La tienda no existe.');
		endif;

		return View::make('front.store', $data);
	}
}