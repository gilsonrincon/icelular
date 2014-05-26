@extends('admin.layout')

@section('body')
	<h2>Editar usuario</h2>
	<div class="well well-lg">
		{{Form::open(array('url'=>'admin/users/'.$user->id.'/edit','action'=>'PATCH', 'class'=>'form-horizontal', 'role'=>'form'))}}
			<div class="form-group">
				{{Form::label('email','Dirección Email',array('class'=>'col-lg-4'))}}
				<div class="col-lg-8">
					<input name="email" type="email" value="{{$user->email}}">
				</div>
			</div>

			<div class="form-group">
				{{Form::label('password', 'Contraseña', array('class'=>'col-lg-4'))}}
				<div class="col-md-8">
					{{Form::password('password')}}
				</div>
			</div>

			<div class="form-group">
				{{Form::label('usertype', 'Typo de usuario', ['class'=>'col-lg-4'])}}
				<div class="col-md-8">
					<select name="usertype">
						@foreach ($usersType as $type)
							<option value="{{$type->id}}" @if ($type->id = $user->user_type)
								selected="selected"
							@endif>{{$type->type}}</option>
						@endforeach
						
					</select>
				</div>
			</div>
			
			<!-- enviar -->
			{{Form::submit('Guardar',array("class"=>"btn btn-default btn-lg btn-success"))}}
		{{Form::close()}}
	</div>
@stop

