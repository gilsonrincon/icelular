<?php



class UtilsController extends BaseController {

	/**
	 * Retorna la lista de stados según el id del país
	*/
	public function statesOps($id){
		$html='';
		
		foreach(Country::find($id)->states() as $state){
			$html.='<option value="'.$state['id'].'">'.$state['state'].'</option>';
		}
		$html.='';
		
		return $html;
	}
	
	/**
	 * Proceso para el inicio de sesión
	**/
	public function login(){
		//si el usuario ya está registrado, entonces se redirige al dashboard del admin
		if(Auth::check()) return Redirect::to('admin');	
		
		//si vienen variables post evalua y autentica
		if(Input::has('email') && Input::has('password')){
			if(Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('password')))){
				if(Auth::user()->user_type == 1)
					return Redirect::to('admin');
				return Redirect::to('admin/profile');
			} else {
				$data['message'] = 'E-mail o contraseña incorrectos.';
				return View::make('login',$data);
			}
		} else {
			return View::make('login');
		}
	}
	
	/**
	 * Finaliza la sesión
	**/
	public function logout(){
		if(Input::has('logout')){
			Auth::logout();
			return Redirect::to('login');
		}
	}
	
}