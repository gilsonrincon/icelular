<?php
namespace Admin;

use View;
use BaseController;
use Input;
use Configuration;
use Redirect;
use User;
use UserType;
use Session;
use Hash;

class UsersController extends \BaseController {

	
	public function index()
	{
		if(Input::has('order_field')){
			$order_field = Input::get('order_field');
		}else{
			$order_field = 'id';
		}
		
		if(Input::has('order_dir')){
			$order_dir = Input::get('order_dir');
		}else{
			$order_dir = 'asc';
		}
		
		if(Input::has('page')){
			$page = Input::get('page');
		}else{
			$page =1 ;
		}


		//obtiene la lista de todas los usuarios
		if(User::all()->count() > 0){
			
			$users = User::where('id','>','0')->orderBy($order_field,$order_dir)->paginate(Configuration::where('name','=','page_count')->first()->value);
		}else{
			$users = User::all();
		}

		//parámetros que deben pasarse a la vista
		$data['order_field'] = $order_field;
		$data['order_dir'] = $order_dir;
		$data['users'] = $users;
		$data['page'] = $page;
		$data['page_name'] = 'users';

		return View::make('admin.usersList',$data);
	}

	//Mostrar el formulario para crear un nuevo usuario
	public function create()
	{
		$data['usersType'] = UserType::all();
		$data['page_name'] = 'users';
		
		return View::make('admin.usersNew', $data);
	}

	//Guardar una nueva tienda
	public function store()
	{
		$user = User::where('email', '=', Input::get('email'))->get();
		if(count($user) > 0):
			return Redirect::to('admin/users/new');
		else:
			$newUser = new User();
			$newUser->email = Input::get('email');
			$newUser->password = Hash::make(Input::get('email'));
			$newUser->user_type = Input::get('user_type'); 
			$newUser->save();
			
			return Redirect::to('admin/users/'.$newUser->id.'/edit');
		endif;
	}


	public function show($id)
	{
		//
	}

	//Editar un usuario
	public function edit($id)
	{
		$data['user'] = User::find($id);
		$data['usersType'] = UserType::all();
		$data['page_name'] = 'users';
		
		return View::make('admin.usersEdit', $data);
	}

	
	public function update($id)
	{
		$user = User::find($id);
		$user->email = Input::get('email');
		if(Input::get('password') != '')
			$user->password = Input::get('password');
		$user->user_type = Input::get('usertype');
		$user->save();
		return Redirect::to('admin/users/'.$id.'/edit');
	}

	//Borrar usuarios
	public function destroy()
	{
		$ids=Input::get('ids');
		
		$ids=trim($ids, ",");
		$ids=explode(",",$ids);
		
		foreach($ids as $id){
			//no se puede eliminar la categoría principal
			if($id!=1){
				$user = User::find($id);
				$user->delete();
			}
		}
		
		return Redirect::to('admin/users');
	}

}