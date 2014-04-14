@extends('admin.layout')

@section("body")
<h2>El comentario se encuentra</h2>
	{{Form::open(array('method'=>'post', 'url'=>'admin/calificaciones/update'))}}
		<select name="status" id="status" class="form-control">
			<option value="0">Deshabilitado</option>
			<option value="1">Habilitado</option>
		</select>
		{{Form::submit('Guardar', array('class' => 'btn btn-default btn-success'))}}
	{{Form::close()}}
@stop

