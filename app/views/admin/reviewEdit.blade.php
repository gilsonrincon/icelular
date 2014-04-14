@extends('admin.layout')

@section("body")
<h2>El comentario se encuentra</h2>
	{{Form::open(array('method'=>'post', 'url'=>'admin/calificaciones/update'))}}
		{{Form::hidden('id', $review->id)}}
		<select name="status" id="status" class="form-control">
			<option value="0" @if ($review->status == 0)
				selected="selected"
			@endif>Deshabilitado</option>
			<option value="1" @if ($review->status == 1)
				selected="selected"
			@endif>Habilitado</option>
		</select>
		{{Form::submit('Guardar', array('class' => 'btn btn-default btn-success'))}}
	{{Form::close()}}
@stop

