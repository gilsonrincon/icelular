@extends('admin.layout')

@section('body')
	<h2>Nuevo Paquete de clics</h2>
	<div class="well well-lg">
		{{Form::open(array('url'=>'admin/packets/new','action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
			<div class="form-group">
				{{Form::label('name','Nombre',array('class'=>'col-lg-4'))}}
				<div class="col-lg-8">
					<input name="name" type="text" required>
				</div>
			</div>

			<div class="form-group">
				{{Form::label('value', 'Valor', array('class'=>'col-lg-4'))}}
				<div class="col-md-8">
					<input name="value" type="text" required>
				</div>
			</div>

			<div class="form-group">
				{{Form::label('clicks', 'Clicks', array('class'=>'col-lg-4'))}}
				<div class="col-md-8">
					<input name="clicks" type="number" required>
				</div>
			</div>

			<!-- enviar -->
			{{Form::submit('Guardar',array("class"=>"btn btn-default btn-lg btn-success"))}}
		{{Form::close()}}
	</div>
@stop

