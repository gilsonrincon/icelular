@extends('admin.layout')

@section('head')
	<title>Administración de calificaciones</title>
@stop

@section('body')
	<div class="row">
		<h2>Reportar una calificación</h2>
		{{Form::open(array('method'=>'POST', 'url'=>'admin/quejas'))}}
			<label class="col-lg-3" for="status">Estado:</label>
			{{Form::hidden('id', $complaint->id)}}
			<select name="status" class="form-control">
				<option value="En espera" @if ($complaint->status == 'En espera')
					selected="selected"
				@endif>En espera</option>
				<option value="Procesando" @if ($complaint->status == 'Procesando')
					selected="selected"
				@endif>Procesando</option>
				<option value="Reclamo reclazado" @if ($complaint->status == 'Rechazado')
					selected="selected"
				@endif>Rechazar reclamo</option>
				<option value="Reclamo Aprobado" @if ($complaint->status == 'Reclamo Aprobado')
					selected="selected"
				@endif>Aprobar - Desactivar la calificación</option>
				<option value="Aprobado y Borrado" @if ($complaint->status == 'Aprobado')
					selected="selected"
				@endif>Aprobar - Borrar la calificación</option>
			</select>
			{{Form::submit('Guardar', array('class' => 'btn btn-default btn-success'))}}
		{{Form::close()}}
	</div>
@stop
