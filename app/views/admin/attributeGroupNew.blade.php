@extends('admin.layout')

{{-- Si se va a editar un registro --}}

@section('body')
	<h2>Nuevo grupo de atributos</h2>
	<div class="well well-lg">
		{{Form::open(array('url'=>'admin/attributes/new-group','action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
			
			<div class="form-group">
				<!-- nombre del grupo-->
				{{Form::label('attributes_group','Nombre:',array('class'=>'col-lg-4'))}}
				<div class="col-lg-8">
					{{Form::text('attributes_group', '',array('placeholder'=>'Grupo de atributos', 'title'=>'Nombre del grupo de atributos', "class"=>"tip form-control"))}}
				</div>
			</div>
			
			<div class="form-group">
				{{Form::label('attributes',"Puede agregar atributos al nuevo grupo:",array("class"=>"col-lg-4"))}}
				<div class="col-lg-8">
					{{Form::textarea("attributes","")}}
					<p class="help-block">Ingrese los atributos que desee añadir al grupo separándolos con (,)</p>
				</div>
			</div>
			
			<!-- enviar -->
			{{Form::submit('Guardar',array("class"=>"btn btn-default btn-lg btn-success"))}}
		{{Form::close()}}
	</div>
@stop

