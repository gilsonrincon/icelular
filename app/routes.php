<?php
/**
 * Acceso principal al sitio
 */
Route::get('/','FrontController@index');

/*********************************************
 * LO REFERENTE AL FRONTEND
*********************************************/
	
	//Ver lista de ofertas para los productos de una determinada categoría
	Route::get('categoria/{id}-{url}.html','FrontController@categoryView');
	
	//Ver ofertas para un producto dado
	Route::get('producto/{id}-{url}.html','FrontController@productView');
	
	
/*********************************************
 * FIN LO REFERENTE AL FRONTEND
*********************************************/


/*************************************
 * Inicio de sesión
*************************************/
	Route::get('login','UtilsController@login');
	Route::post('login','UtilsController@login');
	
	Route::post('logout',"UtilsController@logout");
/*************************************
 * Fin inicio de sesión
*************************************/

/*****************************************************************************************************
 * TODAS LAS RUTAS DE LA ADMINISTRACIÓN ESTÁN AGRUPADAS Y DEPENDEN DEL FILTRO DE LA AUTENTICACIÓN
*****************************************************************************************************/ 
Route::group(array('before'=>"auth"), function(){

	/**
	 * Dash Board para administración del sitio
	**/
	Route::get('admin',array('before'=>'auth', function(){
		return View::make('admin.dashBoard');
	}));
	
	/***********************************************************
	 * Rutas auxiliares para varias tareas en el sistema
	***********************************************************/
		Route::get('utils/get_states_ops/{id}','UtilsController@statesOps');
	/***********************************************************
	 * Fin Rutas auxiliares para varias tareas en el sistema
	***********************************************************/
	
	/***********************************************************
	 * Rutas relacionadas con la administración de categorías
	************************************************************/
	
		//lista de categorías
		Route::get('admin/categories','Admin\CategoriesController@index');
		
		//eliminar un categorías
		Route::post('admin/categories/destroy','Admin\CategoriesController@destroy');
		
		//crear una nueva categoría
		Route::get('admin/categories/new','Admin\CategoriesController@create');
		Route::post('admin/categories/new','Admin\CategoriesController@store');
		
		//editar categoría
		Route::get('admin/categories/{id}/edit','Admin\CategoriesController@edit');
		Route::post('admin/categories/{id}/edit','Admin\CategoriesController@update');
	
	/*****************************************
	 * FIN GESTIÓN DE CATEGORÍAS
	******************************************/
	
	/******************************************
	 * GESTIÓN DE ATRIBUTOS
	******************************************/
	
		//nuevo atributo
		Route::get('admin/attributes', 'Admin\AttributeController@index');
		
		//nuevo grupo de atributos
		Route::get('admin/attributes/new-group', 'Admin\AttributeController@newGroup');
		Route::post('admin/attributes/new-group', 'Admin\AttributeController@saveGroup');
		
		//añadir atributos
		Route::get('admin/attributes/add', 'Admin\AttributeController@addAttributes');
		Route::post('admin/attributes/add', 'Admin\AttributeController@saveAttributes');
		
		//edita la información de un grupo de atributos
		Route::post('admin/attributes/edit-group', 'Admin\AttributeController@editGroup');
		
		//para eliminar un grupo de atributos
		Route::post('admin/attributes/delete-group', 'Admin\AttributeController@deleteGroup');
		
		//para editar un atributo
		Route::post('admin/attributes/edit', 'Admin\AttributeController@editAttr');
		
		//para eliminar un atributo
		Route::post('admin/attributes/delete', 'Admin\AttributeController@deleteAttr');
	
	/*************************************************
	 * FIN GESTIÓN DE ATRIBUTOS
	*************************************************/
	
	
	
	/*************************************************
	 * GESTIÓN DE PRODUCTOS
	*************************************************/
	
		//lista de productos
		Route::get('admin/products','Admin\ProductController@index');
		
		//añdir nuevo producto
		Route::get('admin/products/new','Admin\ProductController@newProduct');
		Route::post('admin/products/new','Admin\ProductController@createProduct');
		
		//editar un producto
		Route::get('admin/products/{id}/edit','Admin\ProductController@editProduct');
		Route::post('admin/products/{id}/edit','Admin\ProductController@updateProduct');
	
		//eliminar un producto
		Route::post('admin/products/destroy','Admin\ProductController@deleteProduct');
		
		//subir imágenes para un producto dado
		Route::post('admin/products/addimage','Admin\ProductController@addImage');
		
		//obtener lista de imágenes relacionadas a un producto dado por querystring product_id
		Route::get('admin/products/getimages','Admin\ProductController@getImages');
		
		//elimina una imagen de un producto dado
		Route::post('admin/products/deleteimage','Admin\ProductController@deleteImage');
	/*************************************************
	 * FIN GESTIÓN DE PRODUCTOS
	**************************************************/
	
	/**************************************************
	 * GESTIÓN DE COMERCIOS / STORES
	**************************************************/
		
		//Lista de tiendas
		Route::get('admin/stores','Admin\StoreController@index');
		
		//añdir nueva tienda
		Route::get('admin/stores/new','Admin\StoreController@newStore');
		Route::post('admin/stores/new','Admin\StoreController@createStore');
		
		//editar una tienda
		Route::get('admin/stores/{id}/edit','Admin\StoreController@editStore');
		Route::post('admin/stores/{id}/edit','Admin\StoreController@updateStore');
	
		//eliminar una tienda
		Route::post('admin/stores/destroy','Admin\StoreController@deleteStore');
		
		//añade una nueva dirección a una tienda
		Route::post('admin/stores/{id}/address/add','Admin\StoreController@addAddress');
		
		//actualizar una dirección a una tienda
		Route::post('admin/stores/address/update','Admin\StoreController@updateAddress');
		
		//lista de direcciones por tienda
		Route::get('admin/stores/{id}/address/list','Admin\StoreController@getAddress');
		
		//obtener información de una dirección
		Route::get('admin/stores/address/{id}/info','Admin\StoreController@getAddressInfo');
		
		//elimina una dirección
		Route::post('admin/stores/address/delete','Admin\StoreController@deleteAddress');
	/**************************************************
	 * FIN GESTIÓN DE COMERCIOS / STORES
	**************************************************/
	
	/*Gestion de clicks disponibles*/
		//Lista de clicks disponibles por tienda
		Route::get('admin/availableclicks', 'Admin\AvailableClicks@index');
		
		//Formulario para editar los clicks disponibles
		Route::get('admin/availableclicks/{id}/edit', 'Admin\AvailableClicks@edit');

		//Envio del formulario para los clicks disponibles
		Route::post('admin/availableclicks/update', 'Admin\AvailableClicks@update');

	/*Reportes de clicks*/
		//Lista de las tiendas
		Route::get('admin/reportclicks', 'Admin\ReportClicks@index');

		//Reporte de la tienda
		Route::get('admin/reportclicks/{id}', 'Admin\ReportClicks@show');
	
	/**************************************************
	 * GESTIÓN CMS
	**************************************************/
		//lista de todos los ítems
		Route::get('admin/cms','Admin\CmsController@index');
		
		//añdir nuevo ítem
		Route::get('admin/cms/new','Admin\CmsController@newItem');
		Route::post('admin/cms/new','Admin\CmsController@createItem');
		
		//editar un ítem
		Route::get('admin/cms/{id}/edit','Admin\CmsController@editItem');
		Route::post('admin/cms/{id}/edit','Admin\CmsController@updateItem');
	
		//eliminar un ítem
		Route::post('admin/cms/destroy','Admin\CmsController@deleteItem');
	/**************************************************
	 * FIN GESTIÓN CMS
	**************************************************/
	
	/**************************************************
	 * GESTIÓN DE LAS OFERTAS
	**************************************************/
		//Muestra el listado de ofertas y la ventana de administración
		Route::get('admin/offers','Admin\OfferController@index');
		
		//Crear una nueva oferta
		Route::get('admin/offers/new','Admin\OfferController@newOffer');
		Route::post('admin/offers/new','Admin\OfferController@createOffer');
		
		//Actualiza la información de una oferta
		Route::get('admin/offers/update/{id}','Admin\OfferController@updateOffer');
		Route::post('admin/offers/update/{id}','Admin\OfferController@saveOffer');
		
		//Eliminación ofertas
		Route::post('admin/offers/destroy','Admin\OfferController@deleteOffers');
	/**************************************************
	 * FIN GESTIÓN DE LAS OFERTAS
	**************************************************/
	
	/**************************************************
	 * GESTIÓN DE BANNERS
	**************************************************/
		//Muestra el listado de banners
		Route::get('admin/banners','Admin\BannerController@index');
		
		//Crear un nuevo banner
		Route::get('admin/banners/new','Admin\BannerController@newBanner');
		Route::post('admin/banners/new','Admin\BannerController@createBanner');
		
		//Actualiza la información de un banner
		Route::get('admin/banners/update/{id}','Admin\BannerController@updateBanner');
		Route::post('admin/banners/update/{id}','Admin\BannerController@saveBanner');
		
		//Eliminación banners
		Route::post('admin/banners/destroy','Admin\BannerController@deleteBanners');
	/**************************************************
	 * FIN GESTIÓN DE BANNERS
	**************************************************/
});
/****************************************************************
 * FIN DE LAS RUTAS AGRUPADAS BAJO EL FILTRO DE AUTENTICACIÓN
****************************************************************/
























