@extends('admin.layout')

{{-- Si se va a editar un registro --}}
@if(isset($edit))
	@section('body')
		<h2>Editar categoría "{{$category->name}}"</h2>
		
		<div class="well well-lg">
			{{Form::open(array('url'=>'admin/categories/'.$category->id.'/edit', 'action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
				
				@if($category['id']>1)
					<div class="form-group">
						<!-- categoría padre -->
						{{Form::label('parent_id','Seleccione la categoría padre',array('class'=>'col-lg-4'))}}
						<div class="col-lg-8">
							{{Form::select('parent_id',$parent_ids,$category->parent_id)}}
						</div>
						
					</div>
				@else
					{{ Form::hidden('parent_id',1)}}
				@endif
				
				<div class="form-group">
					<!-- nombre de la categoría -->
					{{Form::label('name','Nombre de la categoría:',array('class'=>'col-lg-4'))}}
					<div class="col-lg-8">
						{{Form::text('name', $category->name,array('placeholder'=>'Nombre de la categoría', 'title'=>'Nombre de la categoría'))}}
					</div>
				</div>
				
				<div class="form-group">
					<!-- descripción corta -->
					{{Form::label('short_description','Descripción corta:',array('class'=>'col-lg-4'))}}
					<div class="col-lg-8">
						{{Form::textarea('short_description', $category->short_description,array('placeholder'=>'Descripción corta.', 'title'=>'Descripción corta.'))}}
					</div>
				</div>
				
				<div class="form-group">
					<!-- url amigable -->
					{{Form::label('url','URL amigable:',array('class'=>'col-lg-4'))}}
					<div class="col-lg-8">
						<input type="text" name="url" value="{{$category->url}}" />
					</div>
				</div>
				
				<div class="form-group">
					<!-- descripción completa -->
					{{Form::label('description','Descripción completa:',array('class'=>'col-lg-12'))}}
					{{Form::textarea('description', $category->description,array('class'=>'html_editor col-lg-12'))}}
				</div>
				
				<div style="display:none;">
					<!-- posición -->
					{{Form::label('position','Posición:')}}
					{{Form::text('position', $category->position,array('placeholder'=>'Descripción corta.', 'title'=>'Descripción corta.'))}}
				</div>
				
				<!-- enviar -->
				{{Form::submit('Guardar',array("class"=>"btn btn-default btn-lg btn-success"))}}
			{{Form::close()}}
		</div>
	@stop
@else
	@section('body')
		<h2>Nueva categoría</h2>
		<div class="well well-lg">
			{{Form::open(array('url'=>'admin/categories/new','action'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'))}}
				<div class="form-group">
					<!-- categoría padre -->
					{{Form::label('parent_id','Seleccione la categoría padre',array('class'=>'col-lg-4'))}}
					<div class="col-lg-8">
						{{Form::select('parent_id',$parent_ids)}}
					</div>
				</div>
				
				<div class="form-group">
					<!-- nombre de la categoría -->
					{{Form::label('name','Nombre de la categoría:',array('class'=>'col-lg-4'))}}
					<div class="col-lg-8">
						{{Form::text('name', '',array('placeholder'=>'Nombre de la categoría', 'title'=>'Nombre de la categoría'))}}
					</div>
				</div>
				
				<div class="form-group">
					<!-- descripción corta -->
					{{Form::label('short_description','Descripción corta:',array('class'=>'col-lg-4'))}}
					<div class="col-lg-8">
						{{Form::textarea('short_description', '',array('placeholder'=>'Descripción corta.', 'title'=>'Descripción corta.'))}}
					</div>
				</div>
				
				<div class="form-group">
					<!-- url amigable -->
					{{Form::label('url','URL amigable:',array('class'=>'col-lg-4'))}}
					<div class="col-lg-8">
						<input type="text" name="url" value="" />
					</div>
				</div>
				
				<div class="form-group">
					<!-- descripción completa -->
					{{Form::label('description','Descripción completa:',array('class'=>'col-lg-12'))}}
					<div class="col-lg-12">
						{{Form::textarea('description', '',array('class'=>'html_editor'))}}
					</div>
				</div>
				
				<div class="form-group" style="display:none;">
					<!-- posición -->
					{{Form::label('position','Posición:',array("class"=>"col-lg-4"))}}
					<div class="col-lg-8">
						{{Form::text('position', Category::max('position')+1,array('title'=>'Posición'))}}
					</div>
				</div>
				
				<!-- enviar -->
				{{Form::submit('Guardar',array("class"=>"btn btn-default btn-lg btn-success"))}}
			{{Form::close()}}
		</div>
	@stop
@endif

